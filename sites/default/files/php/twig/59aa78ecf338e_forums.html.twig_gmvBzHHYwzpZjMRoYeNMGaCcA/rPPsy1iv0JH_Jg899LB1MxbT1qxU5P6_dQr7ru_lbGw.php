<?php

/* core/themes/classy/templates/dataset/forums.html.twig */
class __TwigTemplate_d6ecae42866b69b5ca8f7c6fc53dcacb5f63a569da0a26d1b989460eb745d712 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $tags = array("if" => 18);
        $filters = array();
        $functions = array("attach_library" => 17);

        try {
            $this->env->getExtension('sandbox')->checkSecurity(
                array('if'),
                array(),
                array('attach_library')
            );
        } catch (Twig_Sandbox_SecurityError $e) {
            $e->setTemplateFile($this->getTemplateName());

            if ($e instanceof Twig_Sandbox_SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof Twig_Sandbox_SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof Twig_Sandbox_SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

        // line 17
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->env->getExtension('drupal_core')->attachLibrary("classy/forum"), "html", null, true));
        echo "
";
        // line 18
        if ((isset($context["forums_defined"]) ? $context["forums_defined"] : null)) {
            // line 19
            echo "  <div class=\"forum\">
    ";
            // line 20
            echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, (isset($context["forums"]) ? $context["forums"] : null), "html", null, true));
            echo "
    ";
            // line 21
            echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, (isset($context["topics"]) ? $context["topics"] : null), "html", null, true));
            echo "
    ";
            // line 22
            echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, (isset($context["topics_pager"]) ? $context["topics_pager"] : null), "html", null, true));
            echo "
  </div>
";
        }
    }

    public function getTemplateName()
    {
        return "core/themes/classy/templates/dataset/forums.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  60 => 22,  56 => 21,  52 => 20,  49 => 19,  47 => 18,  43 => 17,);
    }

    public function getSource()
    {
        return "{#
/**
 * @file
 * Theme override to display a forum.
 *
 * May contain forum containers as well as forum topics.
 *
 * Available variables:
 * - forums: The forums to display (as processed by forum-list.html.twig).
 * - topics: The topics to display.
 * - topics_pager: The topics pager.
 * - forums_defined: A flag to indicate that the forums are configured.
 *
 * @see template_preprocess_forums()
 */
#}
{{ attach_library('classy/forum') }}
{% if forums_defined %}
  <div class=\"forum\">
    {{ forums }}
    {{ topics }}
    {{ topics_pager }}
  </div>
{% endif %}
";
    }
}
