<?php

class View {

    /**
     * holds the data used by the template
     *
     * @var array
     */
    protected $data = array();

    /**
     * sets data to be used in the template file
     *
     * @param sting $name the name used by the template
     * @param string $value the data associated with the name
     */
    public function set($name, $value)
    {
        $this->data[$name] = $value;
    }

    /**
     * outputs the specified template to the browser
     *
     * @param  string $template html
     *
     * @throws Exception If the template is not found
     * would need to eventually do something with the exception
     */
    public function render($template)
    {
        $templatePath = 'templates/' . $template;
        $mainTemplatePath = 'templates/mainTemplate.php';
        if (file_exists($templatePath))
        {
            require($mainTemplatePath);
        } else
        {
            Throw new Exception('View not found');
        }

    }


}