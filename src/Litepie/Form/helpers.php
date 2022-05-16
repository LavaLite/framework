<?php
use Illuminate\Support\Arr;

if (!function_exists('form_merge_values')) {
    /**
     * Merge form array with values.
     *
     * @param array $form
     * @param array $values
     * @param boolean $grouped
     *
     * @return array
     */
    function form_merge_form($form, $value, $grouped = true)
    {
        array_walk($form, function (&$val, $key) use ($value) {
            if (isset($value[$key])) {
                $val['value'] = $value[$key];
            }
        });
        if (!$grouped) {
            return $form;
        }

        return collect($form)->groupBy('group', true)->toArray();

    }
}

if (!function_exists('form_list_html')) {
    /**
     * Merge form array with list values.
     *
     * @param array $form
     * @param array $values
     * @param boolean $grouped
     *
     * @return array
     */
    function form_list_html($form, $seperator = ' ')
    {
        foreach ($form as $key => $val) {
            $list[$key] = Form::list($val)->render();
        }
        return implode($seperator, $list);
    }
}
