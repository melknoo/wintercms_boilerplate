<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* /var/www/html/themes/demo/layouts/default.htm */
class __TwigTemplate_a3d65c0bbd64114415a209cb762e12214a5392daa219cad319c9a344127b91e5 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $this->checkSecurity();
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<!DOCTYPE html>
<html>
    <head>
        <meta charset=\"utf-8\">
        <title>MTG Price Trends - ";
        // line 5
        echo twig_escape_filter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["this"] ?? null), "page", [], "any", false, false, true, 5), "title", [], "any", false, false, true, 5), 5, $this->source), "html", null, true);
        echo "</title>
        <meta name=\"description\" content=\"";
        // line 6
        echo twig_escape_filter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["this"] ?? null), "page", [], "any", false, false, true, 6), "meta_description", [], "any", false, false, true, 6), 6, $this->source), "html", null, true);
        echo "\">
        <meta name=\"title\" content=\"";
        // line 7
        echo twig_escape_filter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["this"] ?? null), "page", [], "any", false, false, true, 7), "meta_title", [], "any", false, false, true, 7), 7, $this->source), "html", null, true);
        echo "\">
        <meta name=\"author\" content=\"Winter CMS\">
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
        <meta name=\"generator\" content=\"Winter CMS\">
        <link rel=\"icon\" type=\"image/png\" href=\"";
        // line 11
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/images/mtg_logo.png");
        echo "\">
        <link href=\"";
        // line 12
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/css/vendor.css");
        echo "\" rel=\"stylesheet\">
        <link href=\"";
        // line 13
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/vendor/jquery-ui/jquery-ui.css");
        echo "\" rel=\"stylesheet\">
        <link href=\"";
        // line 14
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/vendor/font-awesome/css/font-awesome.css");
        echo "\" rel=\"stylesheet\">
        <link href=\"";
        // line 15
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/css/theme.css");
        echo "\" rel=\"stylesheet\">
        <link href=\"";
        // line 16
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/scss/style.css");
        echo "\" rel=\"stylesheet\">
        <script src=\"";
        // line 17
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/vendor/jquery.js");
        echo "\"></script>
        <script src=\"";
        // line 18
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/vendor/jquery-ui/jquery-ui.js");
        echo "\"></script>
        ";
        // line 19
        echo $this->env->getExtension('Cms\Twig\Extension')->assetsFunction('css');
        echo $this->env->getExtension('Cms\Twig\Extension')->displayBlock('styles');
        // line 20
        echo "    </head>
    <body>

        <!-- Header -->
        <header id=\"layout-header\">
            ";
        // line 25
        $context['__cms_partial_params'] = [];
        echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction("site/header"        , $context['__cms_partial_params']        , true        );
        unset($context['__cms_partial_params']);
        // line 26
        echo "        </header>

        <!-- Content -->
        <section id=\"layout-content\">
            ";
        // line 30
        echo $this->env->getExtension('Cms\Twig\Extension')->pageFunction();
        // line 31
        echo "        </section>


        <!-- Footer -->
        <footer id=\"layout-footer\">
            ";
        // line 36
        $context['__cms_partial_params'] = [];
        echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction("site/footer"        , $context['__cms_partial_params']        , true        );
        unset($context['__cms_partial_params']);
        // line 37
        echo "        </footer>


        <!-- Scripts -->
        <script src=\"";
        // line 41
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/vendor/bootstrap.js");
        echo "\"></script>
        <script src=\"";
        // line 42
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/javascript/app.js");
        echo "\"></script>

        ";
        // line 44
        $_minify = System\Classes\CombineAssets::instance()->useMinify;
        echo '<script data-module="snowboard-manifest" src="http://localhost/modules/system/assets/js/build/manifest.js?v=1.2.4"></script>'.PHP_EOL;
        echo '<script data-module="snowboard-vendor" src="http://localhost/modules/system/assets/js/snowboard/build/snowboard.vendor.js?v=1.2.4"></script>'.PHP_EOL;
        echo '<script data-module="snowboard-base" data-base-url="http://localhost/" data-asset-url="http://localhost/" src="http://localhost/modules/system/assets/js/snowboard/build/snowboard.base.js?v=1.2.4"></script>'.PHP_EOL;
        echo '<script data-module="request" src="http://localhost/modules/system/assets/js/snowboard/build/snowboard.request.js?v=1.2.4"></script>'.PHP_EOL;
        echo '<script data-module="attr" src="http://localhost/modules/system/assets/js/snowboard/build/snowboard.data-attr.js?v=1.2.4"></script>'.PHP_EOL;
        echo '<script data-module="extras" src="http://localhost/modules/system/assets/js/snowboard/build/snowboard.extras.js?v=1.2.4"></script>'.PHP_EOL;
        // line 45
        echo "        ";
        echo $this->env->getExtension('Cms\Twig\Extension')->assetsFunction('js');
        echo $this->env->getExtension('Cms\Twig\Extension')->displayBlock('scripts');
        // line 46
        echo "
    </body>
</html>";
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "/var/www/html/themes/demo/layouts/default.htm";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable()
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo()
    {
        return array (  152 => 46,  148 => 45,  140 => 44,  135 => 42,  131 => 41,  125 => 37,  121 => 36,  114 => 31,  112 => 30,  106 => 26,  102 => 25,  95 => 20,  92 => 19,  88 => 18,  84 => 17,  80 => 16,  76 => 15,  72 => 14,  68 => 13,  64 => 12,  60 => 11,  53 => 7,  49 => 6,  45 => 5,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "/var/www/html/themes/demo/layouts/default.htm", "");
    }
    
    public function checkSecurity()
    {
        static $tags = array("styles" => 19, "partial" => 25, "page" => 30, "snowboard" => 44, "scripts" => 45);
        static $filters = array("escape" => 5, "theme" => 11);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['styles', 'partial', 'page', 'snowboard', 'scripts'],
                ['escape', 'theme'],
                []
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->source);

            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

    }
}
