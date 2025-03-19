<?php

if (! function_exists('form_merge_form')) {
    /**
     * Merge form array with values.
     *
     * @param array $form
     * @param array $values
     * @param boolean $grouped
     *
     * @return array
     */
    function form_merge_form($forms, $value, $grouped = true)
    {
        $data = json_decode(json_encode($value), true);
        foreach ($forms as $fkey => $form) {
            foreach ($form as $key => $val) {
                $k = $val['key'];
                if (isset($data['data'][$k])) {
                    $forms[$fkey][$key]['value'] = $data['data'][$k];
                }
                if ($val['element'] == 'file') {
                    $forms[$fkey][$key]['url'] = str_replace('//file', '/' . $k . '/file', $data['meta']['upload_url']);
                }
            }
        }
        return $forms;
    }
}

if (! function_exists('form_merge_list')) {
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

        foreach ($form as $key => $val) {
            $k = $val['key'];
            if (isset($data[$k])) {
                $val['value'] = $data[$k];
            }

            if ($val['type'] == 'file') {
                $val['url'] = str_replace('//file', '/' . $k . '/file', $data['meta']['upload_url']);
            }
            $form[$k] = $val;
            unset($form[$key]);
        }
        return $form;
    }
}

if (! function_exists('form_list_html')) {
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

    if (! function_exists('form')) {
        /**
         * Return the form object.

         *
         * @return object
         */
        function form()
        {
            return app('form');
        }
    }
}
