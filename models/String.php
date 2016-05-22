<?php

    namespace Martin\Strings\Models;

    use Model;
    use Martin\Strings\Classes\Support\Facades\Strings as StringsFacade;

    class String extends Model {

        use \October\Rain\Database\Traits\Validation;

        const TEMPLATE_VARS_TABLE_NAME = 'martin_pages_strings';

        public $table      = self::TEMPLATE_VARS_TABLE_NAME;
        public $primaryKey = 'string_slug';

        public $rules = [
            'string_label' => 'required',
            'string_slug'  => 'required',
            'string_value' => 'required',
            'string_scope' => 'required',
        ];

        protected $guarded  = ['*'];
        protected $fillable = ['string_label', 'string_value', 'string_scope'];

        public function filterFields($fields, $context = null) {
            if($context == 'update') {
                $fields->string_label->disabled = true;
                $fields->string_slug->disabled  = true;
                $fields->string_scope->disabled = true;
                $fields->string_label->required = false;
                $fields->string_slug->required  = false;
                $fields->string_scope->required = false;
            }
        }

        public function scopeStringScope($query, $stringScope) {
            return $query->select('string_label', 'string_slug', 'string_scope', 'string_value')
                ->where('string_scope', $stringScope);
        }

        public function getStringScopeOptions() {
            $stringScopes = [];
            $scopes       = StringsFacade::getScopeStrings();
            foreach($scopes as $scopeName) {
                $stringScopes[$scopeName] = ucfirst($scopeName);
            }
            return $stringScopes;
        }
    }

?>