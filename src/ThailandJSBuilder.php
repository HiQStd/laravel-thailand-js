<?php

namespace Baraear\ThailandJS;

use BadMethodCallException;
use Illuminate\Support\HtmlString;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Traits\Macroable;

class ThailandJSBuilder
{
    use Macroable, Componentable {
        Macroable::__call as macroCall;
        Componentable::__call as componentCall;
    }

    /**
     * The View Factory instance.
     *
     * @var \Illuminate\Contracts\View\Factory
     */
    protected $view;

    /**
     * Create a new HTML builder instance.
     *
     * @param \Illuminate\Contracts\View\Factory $view
     */
    public function __construct(Factory $view)
    {
        $this->view = $view;
    }

    /**
     * Generate a link to a StyleSheet files.
     *
     * @return \Illuminate\Support\HtmlString
     */
    public function styles()
    {
        if (config('thailandjs.use-mix')) {
            $return = $this->toHtmlString('');
        } else {
            $return = $this->toHtmlString('<link rel="stylesheet" href="'.asset(config('thailandjs.path.css').'/uikit.css').'">'.PHP_EOL);
            $return .= $this->toHtmlString('<link rel="stylesheet" href="'.asset(config('thailandjs.path.css').'/jquery.Thailand.min.css').'">'.PHP_EOL);
        }

        return $return;
    }

    /**
     * Generate a link to a JavaScript files.
     *
     * @return \Illuminate\Support\HtmlString
     */
    public function scripts()
    {
        if (config('thailandjs.use-mix')) {
            $return = $this->toHtmlString('');
        } else {
            $return = $this->toHtmlString('<script type="text/javascript" src="'.asset(config('thailandjs.path.js').'/jquery.min.js').'"></script>'.PHP_EOL);
            $return .= $this->toHtmlString('<script type="text/javascript" src="'.asset(config('thailandjs.path.js').'/uikit.js').'"></script>'.PHP_EOL);
            $return .= $this->toHtmlString('<script type="text/javascript" src="'.asset(config('thailandjs.path.js').'/zip.js').'"></script>'.PHP_EOL);
            $return .= $this->toHtmlString('<script type="text/javascript" src="'.asset(config('thailandjs.path.js').'/JQL.min.js').'"></script>'.PHP_EOL);
            $return .= $this->toHtmlString('<script type="text/javascript" src="'.asset(config('thailandjs.path.js').'/typeahead.bundle.js').'"></script>'.PHP_EOL);
            $return .= $this->toHtmlString('<script type="text/javascript" src="'.asset(config('thailandjs.path.js').'/jquery.Thailand.min.js').'"></script>'.PHP_EOL);
        }

        return $return;
    }

    /**
     * Render ThailandJS JavaScript function.
     *
     * @param array|string $attributes
     * @param string $onLoad
     * @param bool $log
     * @return \Illuminate\Support\HtmlString
     */
    public function render($attributes = '', $onLoad = '', $log = false)
    {
        $javascript = '<script type="text/javascript">'.PHP_EOL;
        $javascript .= '    $.Thailand({'.PHP_EOL;
        $javascript .= '        database: \''.asset('js/laravel-thailand-js/database/db.json').'\','.PHP_EOL;
        $javascript .= PHP_EOL;
        if ($attributes != '') {
            $javascript .= '        $district: $(\''.$attributes['district'].'\'),'.PHP_EOL;
            $javascript .= '        $amphoe: $(\''.$attributes['amphoe'].'\'),'.PHP_EOL;
            $javascript .= '        $province: $(\''.$attributes['province'].'\'),'.PHP_EOL;
            $javascript .= '        $zipcode: $(\''.$attributes['zipcode'].'\'),'.PHP_EOL;
        } else {
            $javascript .= '        $district: $(\'#demo1 [name="district"]\'),'.PHP_EOL;
            $javascript .= '        $amphoe: $(\'#demo1 [name="amphoe"]\'),'.PHP_EOL;
            $javascript .= '        $province: $(\'#demo1 [name="province"]\'),'.PHP_EOL;
            $javascript .= '        $zipcode: $(\'#demo1 [name="zipcode"]\'),'.PHP_EOL;
        }
        $javascript .= PHP_EOL;
        if ($log) {
            $javascript .= '        onDataFill: function(data){'.PHP_EOL;
            $javascript .= '            console.info(\'Data Filled\', data);'.PHP_EOL;
            $javascript .= '        },'.PHP_EOL;
            $javascript .= PHP_EOL;
        }
        $javascript .= '        onLoad: function(){'.PHP_EOL;
        if ($log) {
            $javascript .= '            console.info(\'Autocomplete is ready!\');'.PHP_EOL;
        }
        if ($onLoad != '') {
            $javascript .= '            $(\''.$onLoad.'\').toggle();'.PHP_EOL;
        } else {
            $javascript .= '            $(\'#loader, .demo\').toggle();'.PHP_EOL;
        }
        $javascript .= '        }'.PHP_EOL;
        $javascript .= '    });'.PHP_EOL;
        $javascript .= '</script>'.PHP_EOL;

        return $this->toHtmlString($javascript);
    }

    /**
     * Render ThailandJS JavaScript search function.
     *
     * @param string $searchable
     * @param string $prepend
     * @param string $onLoad
     * @param bool $log
     * @return \Illuminate\Support\HtmlString
     */
    public function search($searchable = '', $prepend = '', $onLoad = '', $log = false)
    {
        $javascript = '<script type="text/javascript">'.PHP_EOL;
        $javascript .= '    $.Thailand({'.PHP_EOL;
        $javascript .= '        database: \''.asset('js/laravel-thailand-js/database/db.json').'\','.PHP_EOL;
        $javascript .= PHP_EOL;
        if ($searchable != '') {
            $javascript .= '        $search: $(\''.$searchable.'\'),'.PHP_EOL;
        } else {
            $javascript .= '        $search: $(\'#demo2 [name="search"]\'),'.PHP_EOL;
        }
        $javascript .= PHP_EOL;
        $javascript .= '        onDataFill: function(data){'.PHP_EOL;
        if ($log) {
            $javascript .= '            console.info(\'Data Filled\', data);'.PHP_EOL;
        }
        $javascript .= '            var result = \'ตำบล\' + data.district + \' อำเภอ\' + data.amphoe + \' จังหวัด\' + data.province + \' \' + data.zipcode;'.PHP_EOL;
        if ($prepend != '') {
            $javascript .= '            $(\''.$prepend.'\').prepend(result);'.PHP_EOL;
        } else {
            $javascript .= '            $(\'#demo2-output\').prepend(result);'.PHP_EOL;
        }
        $javascript .= '        },'.PHP_EOL;
        $javascript .= PHP_EOL;
        $javascript .= '        onLoad: function(){'.PHP_EOL;
        if ($log) {
            $javascript .= '            console.info(\'Autocomplete is ready!\');'.PHP_EOL;
        }
        if ($onLoad != '') {
            $javascript .= '            $(\''.$onLoad.'\').toggle();'.PHP_EOL;
        } else {
            $javascript .= '            $(\'#loader, .demo\').toggle();'.PHP_EOL;
        }
        $javascript .= '        }'.PHP_EOL;
        $javascript .= '    });'.PHP_EOL;
        $javascript .= '</script>'.PHP_EOL;

        return $this->toHtmlString($javascript);
    }

    /**
     * Transform the string to an Html serializable object.
     *
     * @param $html
     *
     * @return \Illuminate\Support\HtmlString
     */
    protected function toHtmlString($html)
    {
        return new HtmlString($html);
    }

    /**
     * Dynamically handle calls to the class.
     *
     * @param  string $method
     * @param  array $parameters
     *
     * @return \Illuminate\Contracts\View\View|mixed
     *
     * @throws \BadMethodCallException
     */
    public function __call($method, $parameters)
    {
        if (static::hasComponent($method)) {
            return $this->componentCall($method, $parameters);
        }
        if (static::hasMacro($method)) {
            return $this->macroCall($method, $parameters);
        }
        throw new BadMethodCallException("Method {$method} does not exist.");
    }
}
