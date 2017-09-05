<?php

/* core/themes/classy/templates/dataset/forum-icon.html.twig */
class __TwigTemplate_af3733f671c849b1f5fce612a596fd2ca8c6505ba357eca452397dd602b6b787 extends Twig_Template
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
        $tags = array("set" => 20, "if" => 26);
        $filters = array();
        $functions = array();

        try {
            $this->env->getExtension('sandbox')->checkSecurity(
                array('set', 'if'),
                array(),
                array()
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

        // line 20
        $context["classes"] = array(0 => "forum__icon", 1 => ("forum__topic-status--" .         // line 22
(isset($context["icon_status"]) ? $context["icon_status"] : null)));
        // line 25
        echo "<div";
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->getAttribute((isset($context["attributes"]) ? $context["attributes"] : null), "addClass", array(0 => (isset($context["classes"]) ? $context["classes"] : null)), "method"), "html", null, true));
        echo ">
  ";
        // line 26
        if ((isset($context["first_new"]) ? $context["first_new"] : null)) {
            // line 27
            echo "<a id=\"new\"></a>";
        }
        // line 29
        echo "  <span class=\"visually-hidden\">";
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, (isset($context["icon_title"]) ? $context["icon_title"] : null), "html", null, true));
        echo "</span>
</div>
";
    }

    public function getTemplateName()
    {
        return "core/themes/classy/templates/dataset/forum-icon.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  56 => 29,  53 => 27,  51 => 26,  46 => 25,  44 => 22,  43 => 20,);
    }

    public function getSource()
    {
        return "{#
/**
 * @file
 * Theme override to display a status icon for a forum post.
 *
 * Available variables:
 * - attributes: HTML attributes to be applied to the wrapper element.
 *   - class: HTML classes that determine which icon to display. May be one of
 *     'hot', 'hot-new', 'new', 'default', 'closed', or 'sticky'.
 *   - title: Text alternative for the forum icon.
 * - icon_title: Text alternative for the forum icon, same as above.
 * - new_posts: '1' when this topic contains new posts, otherwise '0'.
 * - first_new: '1' when this is the first topic with new posts, otherwise '0'.
 * - icon_status: Indicates which status icon should be used.
 *
 * @see template_preprocess_forum_icon()
 */
#}
{%
  set classes = [
    'forum__icon',
    'forum__topic-status--' ~ icon_status,
  ]
%}
<div{{ attributes.addClass(classes) }}>
  {% if first_new -%}
    <a id=\"new\"></a>
  {%- endif %}
  <span class=\"visually-hidden\">{{ icon_title }}</span>
</div>
";
    }
}
