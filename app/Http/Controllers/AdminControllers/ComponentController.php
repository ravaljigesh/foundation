<?php
namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\AdminController;
use Request;
use Illuminate\Support\Facades\Cache;
use App\Objects\Configuration;
use Input;
use Schema;
use Illuminate\Database\Schema\Blueprint;
use View;

class ComponentController extends AdminController
{
    private $admin_controller;

    private $front_controller;

    private $object;

    public function __construct()
    {
        parent::__construct();
        View::addLocation(base_path('resources/views'));
    }

    public function initContentCreate($id = null)
    {
        $component = $this->context->component;
        if ($id) {
            $component = $this->context->component->find($id);
        }

        $column_types = [
          'string' => 'Varchar',
          'integer' => 'Integer',
          'incremental' => 'Auto Incremental',
          'bigInteger' => 'Big Integer',
          'text' => 'Text',
          'longText' => 'Long Text',
          'datetime' => 'Date Time',
          'date' => 'Date',
          'time' => 'time',
          'decimal' => 'Decimal'
        ];

        $this->page['action_links'][] = [
          'text' => 'Add fields',
          'slug' => '#',
          'icon' => '<i class="la la-plus"></i>',
          'class' => '_ac'
        ];

        $this->page['action_links'][] = [
          'text' => 'List',
          'slug' => 'component/list',
          'icon' => '<i class="la la-plus"></i>'
        ];

        $optionValue = array('1' => 'Yes', '0' => 'No');

        $this->component = $component;

        $this->assign = [
          'optionValue' => $optionValue,
          'column_types' => $column_types,
        ];

        return $this->template('component.create');
    }

    public function initProcessCreate($id = null)
    {
        $data = $this->context->core->validateFields();

        if (!$id && Schema::hasTable(Input::get('table'))) {
          return json('error', t('Table already exists'));
        }

        $component = $this->context->component;

        if (!$id && $component->check('variable', Input::get('variable'))) {
          return json('error', t('Variable is already in use, please choose another'));
        }

        if ($id) {
          $component = $this->context->component->find($id);
        }

        $this->component = $component;

        $component->name = $data->name;
        $component->table = Input::get('table');
        $component->variable = Input::get('variable');
        $component->slug = Input::get('slug');
        $component->controller = Input::get('controller');
        $component->is_admin_create = Input::get('is_admin_create');
        $component->is_admin_list = Input::get('is_admin_list');
        $component->is_admin_delete = Input::get('is_admin_delete');
        $component->is_admin_list = Input::get('is_admin_list');
        $component->is_admin_delete = Input::get('is_admin_delete');
        $component->is_front_create = Input::get('is_front_create');
        $component->is_front_view = Input::get('is_front_view');
        $component->is_front_list = Input::get('is_front_list');
        $component->save();

        if ($id && count($component->fields)) {
          $component->fields()->delete();
        }

        $fields = Input::get('field');
        if (count($fields)) {
          $field_type = Input::get('field_type');
          $required = Input::get('required_field');
          $listing = Input::get('use_in_listing');
          $default = Input::get('default');
          $fillable = Input::get('fillable');
          $class = Input::get('class');

          foreach ($fields as $key => $field) {
            if (!$field) {
              continue;
            }

            $cf = new \App\Objects\ComponentFields;
            $cf->id_component = $component->id;
            $cf->field_name = $field;
            $cf->column_type = $field_type[$key];
            $cf->required = $required[$key];
            $cf->use_in_listing = $listing[$key];
            $cf->is_fillable = $fillable[$key];
            $cf->default = $default[$key];
            $cf->class = $class[$key];
            $cf->save();
          }
        }

        $this->initProcessCreateTable($data); //Check 1 Done
        if (!$id) {
          $this->initProcessContextFile($data); //Check 1 Done
          $this->initProcessObjectFile($data); //Check 1 Done
          $this->initProcessControllerFile($data); //Check 1 Done
          $this->initProcessRouteFile(); //Check 1 Done
          $this->initProcessViewFile();  //Check 1 Done
        }

        pre('Full process done');

        if ($id) {
          return json('success', 'Component Update');
        }

        return json('success', 'Component Save');
    }

    public function initProcessCreateTable($data)
    {

        if (Schema::hasTable(Input::get('table'))) {
          Schema::table(Input::get('table'), function($table) {
            $generic_keys = ['id', 'id_website', 'id_lang', 'created_at', 'updated_at', 'deleted_at'];
            $fields = makeColumn(Input::get('field'));
            $table_columns = Schema::getColumnListing(Input::get('table'));
            $fi = array_diff($table_columns, $fields);
            if (count($fi)) {
              $field_filter = array_diff($fi, $generic_keys);
            }

            if (count($field_filter)) {
              foreach ($field_filter as $f) {
                if (Schema::hasColumn(Input::get('table'), $f)) {
                  $table->dropColumn(makeColumn($f));
                }
              }
            }

            $column_type = Input::get('field_type');
            $required = Input::get('required_field');
            $default = Input::get('default');
            $l = null;

            if (count($fields)) {
              foreach ($fields as $key => $column) {
                $column = str_slug($column);
                $column = str_replace('-', '_', $column);

                if ($column && !Schema::hasColumn(Input::get('table'), $column)) {
                  if (!$column_type[$key]) {
                    return json('error', 'Please provide column type for ' . $column);
                  }
                  if ($column_type[$key] == 'string') {
                    $l = 255;
                  }

                  if (isset($default[$key])) {
                    $d = $default[$key];
                  } else {
                    $d = null;
                  }

                  if ($column_type[$key] == 'integer') {
                    $table->{$column_type[$key]}($column)->after('id_website')->unsigned();
                  } else {
                    $table->{$column_type[$key]}($column, $l)->after('id_website')->default($d);
                  }
                }
              }
            }
            $table->engine = 'InnoDB';
          });
        } else {
          Schema::create(Input::get('table'), function (Blueprint $table) {
            $fields = Input::get('field');
            $column_type = Input::get('field_type');
            $required = Input::get('required_field');
            $default = Input::get('default');
            $l = null;

            $table->increments('id');

            if (count($fields)) {
              foreach ($fields as $key => $column) {
                if ($column) {
                  $column = str_slug($column);
                  $column = str_replace('-', '_', $column);

                  if (!$column_type[$key]) {
                    return json('error', 'Please provide column type for ' . $column);
                  }
                  if ($column_type[$key] == 'string') {
                    $l = 255;
                  }

                  if (isset($default[$key])) {
                    $d = $default[$key];
                  } else {
                    $d = null;
                  }

                  if ($column_type[$key] == 'integer') {
                    $table->{$column_type[$key]}($column)->unsigned();
                  } else {
                    $table->{$column_type[$key]}($column, $l)->default($d);
                  }
                }
              }
            }

            $table->integer('id_website')->unsigned()->nullable();
            $table->integer('id_lang')->unsigned()->nullable();
            $table->engine = 'InnoDB';
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
            $table->timestamp('deleted_at')->nullable();
          });
        }
    }

    public function initProcessContextFile($data)
    {
        $ref = new \ReflectionClass($this->context);
        $p = array_keys($ref->getDefaultProperties());
        $last_property = end($p);

        $file = fopen(base_path('app/Classes/Context.php'), 'r+');
        $lines = file(base_path('app/Classes/Context.php'), FILE_IGNORE_NEW_LINES);
        foreach ($lines as $line => $text) {
          if (strpos($text, 'protected $' . $last_property)) {
            $lines[$line + 1] = formatLine('protected $' . Input::get('variable') . ';');
          }
        }

        foreach ($lines as $line => $text) {
          fwrite($file, $text.PHP_EOL);
        }

        fclose($file);
    }

    public function initProcessObjectFile($data)
    {
        $object = explode('_', Input::get('variable'));
        foreach ($object as $key => $d) {
          $object[$key] = ucfirst($d);
        }

        $object = implode(',', $object);
        $object = str_replace('_', '', Input::get('variable'));
        $object = ucfirst($object);
        $this->object = $object;

        $pass = [
          'object' => $object,
          'table' => Input::get('table')
        ];

        //AdminController process
        $html = view('objecttemplate', $pass);
        $core = $this->context->core;
        $core->prepareHTML($html);
        $html = $core->buildHTML();
        $file = fopen(base_path('app/Objects/' . $object . '.php'), 'w');
        fwrite($file, '<?php' . PHP_EOL . $html);
        fclose($file);
    }

    public function initProcessControllerFile($data)
    {
        if (Input::get('is_controller_needed') == 'none') {
          return true;
        }

        $pass = [
          'variable' => Input::get('variable'),
          'fields' => Input::get('field'),
          'is_admin_list' => Input::get('is_admin_list'),
          'is_admin_create' => Input::get('is_admin_create'),
          'is_admin_delete' => Input::get('is_admin_delete'),
        ];

        //AdminController process
        if (Input::get('controller') == 'both' || Input::get('controller') == 'admin') {
          $html = view('admincontrollertemplate', $pass);
          $core = $this->context->core;
          $core->prepareHTML($html);
          $html = $core->buildHTML();
          $this->admin_controller = ucfirst(Input::get('variable')) . 'Controller.php';
          $file = fopen(base_path('app/Http/Controllers/AdminControllers/' . $this->admin_controller), 'w');
          fwrite($file, '<?php' . PHP_EOL . $html);
          fclose($file);
        }

        //FrontController Process
        if (Input::get('controller') == 'both' || Input::get('controller') == 'front') {
          $html = view('frontcontrollertemplate', $pass);
          $core = $this->context->core;
          $core->prepareHTML($html);
          $html = $core->buildHTML();
          $this->front_controller = ucfirst(Input::get('variable')) . 'Controller.php';
          $file = fopen(base_path('app/Http/Controllers/FrontControllers/' . $this->front_controller), 'w');
          fwrite($file, '<?php' . PHP_EOL . $html);
          fclose($file);
        }
    }

    public function initProcessRouteFile()
    {
        if (!Input::get('slug')) {
          return true;
        }

        $this->initProcessRouteWeb();
        $this->initProcessRouteAdmin();
    }

    public function initProcessRouteAdmin()
    {
        if (Input::get('controller') != 'admin' && Input::get('controller') != 'both') {
          return true;
        }

        if (!file_exists(base_path('app/Http/Controllers/AdminControllers/' . $this->admin_controller))) {
          return json('error', 'Admin Controller file was not initiated');
        }

        $route = Input::get('slug');
        $file = fopen(base_path('routes/admin.php'), 'r+'); //Open File
        $lines = file(base_path('routes/admin.php'), FILE_IGNORE_NEW_LINES); //Take line as array
        $add = [];
        $admin_controller = str_replace('.php', '', $this->admin_controller);

        if (Input::get('is_admin_create')) {
          $add[] = "Route::get('$route/add', 'AdminControllers\\$admin_controller@initContentCreate');";
          $add[] = "Route::post('$route/add', 'AdminControllers\\$admin_controller@initProcessCreate');";
          $add[] = "Route::get('$route/edit/{id}', 'AdminControllers\\$admin_controller@initContentCreate');";
          $add[] = "Route::post('$route/edit/{id}', 'AdminControllers\\$admin_controller@initProcessCreate');";
        }

        if (Input::get('is_admin_list')) {
          $add[] = "Route::get('$route', 'AdminControllers\\$admin_controller@initListing');";
        }

        if (Input::get('is_admin_delete')) {
          $add[] = "Route::get('$route/delete/{id}', 'AdminControllers@initProcessDelete');";
        }

        $add_line = "\t\t\t\t// Added from component controller\n";
        foreach ($add as $a) {
          $add_line .= formatLine2($a, 4);
        }

        if ($add_line) {
          foreach ($lines as $line => $text) {
            if (strpos($text, "['middleware' => ['admins']")) {
              $lines[$line + 1] = $add_line;
            }
          }
        }

        foreach ($lines as $line => $text) {
          fwrite($file, $text.PHP_EOL);
        }

        fclose($file);
    }

    public function initProcessRouteWeb()
    {
        if (Input::get('controller') != 'front' && Input::get('controller') != 'both') {
          return true;
        }

        if (!file_exists(base_path('app/Http/Controllers/FrontControllers/' . $this->front_controller))) {
          return json('error', 'Front Controller file was not initiated');
        }

        $route = Input::get('slug');
        $file = fopen(base_path('routes/web.php'), 'r+'); //Open File
        $lines = file(base_path('routes/web.php'), FILE_IGNORE_NEW_LINES); //Take line as array
        $add = [];
        $front_controller = str_replace('.php', '', $this->front_controller);

        if (Input::get('is_front_create')) {
          $add[] = "Route::get('$route/add', 'FrontControllers\\$front_controller@initContentCreate');";
          $add[] = "Route::post('$route/add', 'FrontControllers\\$front_controller@initProcessCreate');";
        }

        if (Input::get('is_front_list')) {
          $add[] = "Route::get('$route', 'FrontControllers\\$front_controller@initListing');";
        }

        if (Input::get('is_front_view')) {
          $add[] = "Route::get('$route/{url}', 'FrontControllers\\$front_controller@initContent');";
        }

        $add_line = "\t// Added from component controller\n";
        foreach ($add as $a) {
          if (Input::get('is_login_needed')) {
            $add_line .= formatLine2($a, 1);
          } else {
            $add_line .= formatLine2($a, 0);
          }
        }

        if ($add_line) {
          foreach ($lines as $line => $text) {
            if (Input::get('is_login_needed') && strpos($text, "['middleware' => 'auth']")) {
              $lines[$line + 1] = $add_line;
            } elseif (!Input::get('is_login_needed') && strpos($text, 'Route Starts')) {
              $lines[$line + 2] = $add_line;
            }
          }
        }

        foreach ($lines as $line => $text) {
          fwrite($file, $text.PHP_EOL);
        }

        fclose($file);
    }

    public function initProcessViewFile()
    {
        $this->initProcessGenerateFrontViewFiles();
        $this->initProcessGenerateAdminViewFiles();
    }

    public function initProcessGenerateFrontViewFiles()
    {
        if (Input::get('controller') != 'front' && Input::get('controller') != 'both') {
          return true;
        }

        if (Input::get('is_front_create')) {
          $html = file_get_contents(base_path('resources/views/create-template-front.blade.php'));
          $dir = config('settings.front_theme_abs') . '/templates/' . Input::get('variable');
          writeFile($dir, 'create.blade.php', $html);
        }

        if (Input::get('is_front_list')) {
          $html = file_get_contents(base_path('resources/views/list-template-front.blade.php'));
          $dir = config('settings.front_theme_abs') . '/templates/' . Input::get('variable');
          writeFile($dir, 'list.blade.php', $html);
        }

        if (Input::get('is_front_view')) {
          $html = file_get_contents(base_path('resources/views/view-template-front.blade.php'));
          $dir = config('settings.front_theme_abs') . '/templates/' . Input::get('variable');
          writeFile($dir, 'view.blade.php', $html);
        }
    }

    public function initProcessGenerateAdminViewFiles()
    {
        if (Input::get('controller') != 'admin' && Input::get('controller') != 'both') {
          return true;
        }

        if (Input::get('is_admin_create')) {
          $html = file_get_contents(base_path('resources/views/create-template-admin.blade.php'));
          $dir = config('settings.admin_theme_abs') . '/templates/' . Input::get('variable');
          writeFile($dir, 'create.blade.php', $html);
        }

        if (Input::get('is_admin_list')) {
          $html = file_get_contents(base_path('resources/views/list-template-admin.blade.php'));
          $dir = base_path('themes/admin/' . config('settings.admin_theme') . '/templates/' . Input::get('variable'));
          writeFile($dir, 'list.blade.php', $html);
        }
    }

    public function initListing()
    {
        $this->page['action_links'][] = [
          'text' => 'Add Table',
          'slug' => 'component/create',
          'icon' => '<i la la-plus></i>',
        ];

        $components = $this->context->component
        ->orderBy('table', 'acs')
        ->paginate(15);

        $this->assign = [
            'components' => $components
        ];

        return $this->template('component.list');
    }

    public function initDeleting($id)
    {
        $this->context->component->find($id)->delete();
        $this->context->component_fields
        ->where('id_component', $id)
        ->delete();
    }
}
