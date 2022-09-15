<?php

if (!function_exists('form_merge_form')) {
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
        $value = $value->toArray([]);
        array_walk($form, function (&$val, $key) use ($value) {
            if (isset($value[$key])) {
                $val['value'] = $value[$key];
            }
            if ($val['element'] == 'file') {
                $val['url'] = str_replace('//file', '/' . $key . '/file', $value['meta']['upload_url']);
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
