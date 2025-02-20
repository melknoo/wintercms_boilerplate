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

/* /var/www/html/themes/demo/partials/site/header.htm */
class __TwigTemplate_1950b00bc62c14bada3b9aa16f39713d3d27120c373e6a0d730dea670b3c1c8f extends Template
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
        echo "<!-- Nav -->
<nav id=\"layout-nav\" class=\"navbar navbar-inverse navbar-fixed-top navbar-autohide\" role=\"navigation\">
    <div class=\"container\">
        <div class=\"mtg--navbar-header navbar-header\">
            <button type=\"button\" class=\"navbar-toggle\" data-toggle=\"collapse\" data-target=\".navbar-main-collapse\">
                <span class=\"sr-only\">Toggle navigation</span>
                <span class=\"icon-bar\"></span>
                <span class=\"icon-bar\"></span>
                <span class=\"icon-bar\"></span>
            </button>
            <a class=\"navbar-brand\" href=\"/\">MTG Price Trends</a>
        </div>
        <div class=\"collapse navbar-collapse navbar-main-collapse\">
            <ul class=\"nav navbar-nav\">
                <li class=\"separator hidden-xs\"></li>
                <li class=\"";
        // line 16
        if ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["this"] ?? null), "page", [], "any", false, false, true, 16), "id", [], "any", false, false, true, 16) == "home")) {
            echo "active";
        }
        echo "\"><a href=\"/\">Magic Karten</a></li>
                <li class=\"";
        // line 17
        if ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["this"] ?? null), "page", [], "any", false, false, true, 17), "id", [], "any", false, false, true, 17) == "suche")) {
            echo "active";
        }
        echo "\"><a href=\"";
        echo $this->extensions['Cms\Twig\Extension']->pageFilter("suche");
        echo "\">Suche</a></li>
                <li class=\"";
        // line 18
        if ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["this"] ?? null), "page", [], "any", false, false, true, 18), "id", [], "any", false, false, true, 18) == "login")) {
            echo "active";
        }
        echo "\">
                    <a href=\"";
        // line 19
        echo $this->extensions['Cms\Twig\Extension']->pageFilter("login");
        echo "\">
                        ";
        // line 20
        if ( !($context["user"] ?? null)) {
            // line 21
            echo "                            Login
                        ";
        } else {
            // line 23
            echo "                            ";
            echo twig_escape_filter($this->env, $this->sandbox->ensureToStringAllowed((($__internal_compile_0 = ($context["user"] ?? null)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0["name"] ?? null) : null), 23, $this->source), "html", null, true);
            echo "
                        ";
        }
        // line 25
        echo "                    </a>
                </li>
                ";
        // line 27
        if (($context["user"] ?? null)) {
            // line 28
            echo "                <li class=\"\" ><a data-request=\"onLogout\" href=\"\" data-request-data=\"redirect: '/'\">Abmelden</a></li>
                ";
        }
        // line 30
        echo "                <!--<li class=\"";
        if ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["this"] ?? null), "page", [], "any", false, false, true, 30), "id", [], "any", false, false, true, 30) == "import")) {
            echo "active";
        }
        echo "\"><a href=\"";
        echo $this->extensions['Cms\Twig\Extension']->pageFilter("import");
        echo "\">Import</a></li>-->
            </ul>
        </div>
    </div>
</nav>
<div class=\"jumbotron mtg--header-img\">
    <div class=\"container\">
    </div>
</div>";
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "/var/www/html/themes/demo/partials/site/header.htm";
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
        return array (  102 => 30,  98 => 28,  96 => 27,  92 => 25,  86 => 23,  82 => 21,  80 => 20,  76 => 19,  70 => 18,  62 => 17,  56 => 16,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "/var/www/html/themes/demo/partials/site/header.htm", "");
    }
    
    public function checkSecurity()
    {
        static $tags = array("if" => 16);
        static $filters = array("page" => 17, "escape" => 23);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['if'],
                ['page', 'escape'],
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
