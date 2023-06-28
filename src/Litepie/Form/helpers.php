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
            $key = $val['key'];
            if (isset($data['data'][$key])) {
                $val['value'] = $data['data'][$key];
            }
            if ($val['element'] == 'file') {
                $val['url'] = str_replace('//file', '/' . $key . '/file', $data['meta']['upload_url']);
            }
        });

        if (!$grouped) {
            return  $form;
        }

        return collect($form)->groupBy('group', true)->toArray();
    }
}


if (!function_exists('form_merge_list')) {
    /**
     * Merge form array with values.
     *
     * @param array $form
     * @param array $values
     * @param boolean $grouped
     *
     * @return array
     */
    function form_merge_list($form, $value)
    {
        $data = json_decode(json_encode($value), true);

        foreach($form as  $key => $val){
            $k = $val['key'];
            if (isset($data[$k])) {
                $val['value'] = $data[$k];
            }

            if ($val['type'] == 'file') {
                $val['url'] = str_replace('//file', '/' . $k . '/file', $data['meta']['upload_url']);
            }
            $form[$k]  = $val;
            unset($form[$key]);
        }
        return $form;
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
