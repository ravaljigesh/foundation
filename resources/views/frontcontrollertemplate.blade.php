
namespace App\Http\Controllers\FrontControllers;

use App\Http\Controllers\FrontController;
use Input;
use Illuminate\Http\Request;

class {{ ucfirst($variable) }}Controller extends FrontController
{
    public function __construct()
    {
        $this->component = $this->context->{{ $variable }}
        ->where(['variable' => '{{ $variable }}'])
        ->first();

        parent::__contruct();
    }

    public function initListing()
    {
        ${{ $variable }} = $this->context->{{ $variable }}
        ->orderBy('id', 'desc')
        ->paginate(25);

        $this->assign = [
          '{{ $variable }}' => ${{ $variable }}
        ];

        return $this->template('{{ $variable }}.list');
    }

    public function initContentCreate($id = null)
    {
        $this->obj = $this->context->{{ $variable }};
        if ($id) {
          $this->obj = $this->obj->find($id);
        }

        $this->assign = [
          '{{ $variable }}' => $this->obj
        ];

        return $this->template('{{ $variable }}.create');
    }

    public function initContent($url = null)
    {
        ${{ $variable }} = $this->context->{{ $variable }}->findByURL($url);

        $this->assign = [
          '{{ $variable }}' => ${{ $variable }}
        ];

        return $this->template('{{ $variable }}.view');
    }
}
