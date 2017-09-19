<?php

/* core/themes/stable/templates/field/responsive-image.html.twig */
class __TwigTemplate_119b5ed186009dc0177d23e6e473ea37cc430fc2518147dd024fb858eff6aa6e extends Twig_Template
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
        $tags = array("if" => 16, "for" => 26);
        $filters = array();
        $functions = array();

        try {
            $this->env->getExtension('sandbox')->checkSecurity(
                array('if', 'for'),
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

        // line 16
        if ((isset($context["output_image_tag"]) ? $context["output_image_tag"] : null)) {
            // line 17
            echo "  ";
            echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, (isset($context["img_element"]) ? $context["img_element"] : null), "html", null, true));
            echo "
";
        } else {
            // line 19
            echo "  <picture>
    ";
            // line 20
            if ((isset($context["sources"]) ? $context["sources"] : null)) {
                // line 21
                echo "      ";
                // line 25
                echo "      <!--[if IE 9]><video style=\"display: none;\"><![endif]-->
      ";
                // line 26
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable((isset($context["sources"]) ? $context["sources"] : null));
                foreach ($context['_seq'] as $context["_key"] => $context["source_attributes"]) {
                    // line 27
                    echo "        <source";
                    echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, $context["source_attributes"], "html", null, true));
                    echo "/>
      ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['source_attributes'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 29
                echo "      <!--[if IE 9]></video><![endif]-->
    ";
            }
            // line 31
            echo "    ";
            // line 32
            echo "    ";
            echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, (isset($context["img_element"]) ? $context["img_element"] : null), "html", null, true));
            echo "
  </picture>
";
        }
    }

    public function getTemplateName()
    {
        return "core/themes/stable/templates/field/responsive-image.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  80 => 32,  78 => 31,  74 => 29,  65 => 27,  61 => 26,  58 => 25,  56 => 21,  54 => 20,  51 => 19,  45 => 17,  43 => 16,);
    }

    public function getSource()
    {
        return "{#
/**
 * @file
 * Theme override of a responsive image.
 *
 * Available variables:
 * - sources: The attributes of the <source> tags for this <picture> tag.
 * - img_element: The controlling image, with the fallback image in srcset.
 * - output_image_tag: Whether or not to output an <img> tag instead of a
 *   <picture> tag.
 *
 * @see template_preprocess()
 * @see template_preprocess_responsive_image()
 */
#}
{% if output_image_tag %}
  {{ img_element }}
{% else %}
  <picture>
    {% if sources %}
      {#
      Internet Explorer 9 doesn't recognise source elements that are wrapped in
      picture tags. See http://scottjehl.github.io/picturefill/#ie9
      #}
      <!--[if IE 9]><video style=\"display: none;\"><![endif]-->
      {% for source_attributes in sources %}
        <source{{ source_attributes }}/>
      {% endfor %}
      <!--[if IE 9]></video><![endif]-->
    {% endif %}
    {# The controlling image, with the fallback image in srcset. #}
    {{ img_element }}
  </picture>
{% endif %}
";
    }
}
