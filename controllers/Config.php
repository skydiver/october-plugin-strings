<?php

    namespace Martin\Strings\Controllers;

    use App, BackendMenu, Lang, Request, Flash;
    use Illuminate\Database\QueryException;
    use System\Classes\SettingsManager;
    use Backend\Classes\Controller as BackendController;

    use Martin\Strings\Classes\StringException;
    use Martin\Strings\Plugin;
    use Martin\Strings\Models\String;

    class Config extends BackendController {

        public $implement = [
            'Backend.Behaviors.FormController',
            'Backend.Behaviors.ListController'
        ];

        public $requiredPermissions = ['martin.strings.manage_strings'];

        public $formConfig = 'config_form.yaml';
        public $listConfig = 'config_list.yaml';

        public function __construct() {
            parent::__construct();
            BackendMenu::setContext('Martin.Strings', 'pages_strings');
            $this->addJs('/plugins/martin/strings/assets/js/pagesstrings.js');
        }

        public function onCreateString() {
            $this->asExtension('FormController')->create();
            return $this->makePartial('create_string');
        }

        public function onCreate() {
            try {
                $this->asExtension('FormController')->create_onSave();
                return $this->listRefresh();
            } catch (QueryException $exc) {
                App::make('Illuminate\Contracts\Debug\ExceptionHandler')
                    ->report($exc);
                throw new StringException('', $exc->getCode());
            }
        }

        public function onUpdateString() {
            $this->asExtension('FormController')->update(post('record_id'));
            $this->vars['recordId'] = post('record_id');
            return $this->makePartial('update_string');
        }

        public function onUpdate() {
             try {
                $this->asExtension('FormController')->update_onSave(post('record_id'));
                return $this->listRefresh();
            } catch (QueryException $exc) {
                App::make('Illuminate\Contracts\Debug\ExceptionHandler')
                    ->report($exc);
                throw new StringException('', $exc->getCode());
            }
        }

        public function onDelete() {
            $checkedIds = post('checked') ?: (array)post('record_id');
            try {
                if (is_array($checkedIds) && count($checkedIds)) {
                    foreach ($checkedIds as $recordId) {
                        if(!$record = String::find($recordId)) {
                            continue;
                        }
                        $record->delete();
                    }
                    Flash::success(Lang::get('backend::lang.list.delete_selected_success'));
                } else {
                    Flash::error(Lang::get('backend::lang.list.delete_selected_empty'));
                }
            } catch (QueryException $exc) {
                App::make('Illuminate\Contracts\Debug\ExceptionHandler')->report($exc);
                throw new StringException('', $exc->getCode());
            }
            return $this->listRefresh();
        }

    }

?>