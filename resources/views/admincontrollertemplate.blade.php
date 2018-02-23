namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\AdminController;
use Input;
use Illuminate\Http\Request;

class {{ ucfirst($variable) }}Controller extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->component = $this->context->component
        ->where(['variable' => '{{ $variable }}'])
        ->first();
    }

    public function initListing()
    {
        ${{ $variable }} = $this->context->{{ $variable }}
        ->orderBy('id', 'desc')
        ->paginate(25);

        $this->obj = ${{ $variable }};

        $listable = $this->component->fields
        ->where('use_in_listing', 1);

        $this->assign = [
          'listable' => $listable
        ];

        return $this->template('{{ $variable }}.list');
    }

    public function initContentCreate($id = null)
    {
        $this->obj = $this->context->{{ $variable }};
        if ($id) {
          $this->obj = $this->obj->find($id);
        }

        $fillable = $this->component->fields
        ->where('is_fillable', 1);

        $this->assign = [
          'fillable' => $fillable
        ];

        return $this->template('{{ $variable }}.create');
    }
}
