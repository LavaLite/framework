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
        $data = json_decode(json_encode($value), true);

        array_walk($form, function (&$val, $key) use ($data) {
            if (isset($data['data'][$key])) {
                $val['value'] = $data['data'][$key];
            }
            if ($val['element'] == 'file') {
                $val['url'] = str_replace('//file', '/' . $key . '/file', $data['meta']['upload_url']);
            }
        });

        if (!$grouped) {
            $data['form'] = $form;
            return $data;
        }

        $data['form'] = collect($form)->groupBy('group', true)->toArray();
        return $data;
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
