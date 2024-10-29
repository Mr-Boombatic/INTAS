<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;
use Twig\TemplateWrapper;

/* create_route.html.twig */
class __TwigTemplate_c099231eba41729267a1052c05376ca0 extends Template
{
    private Source $source;
    /**
     * @var array<string, Template>
     */
    private array $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 1
        yield "<!DOCTYPE html>
<html lang=\"ru\">
<head>
    <meta charset=\"UTF-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <title>Форма внесения данных в расписание</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
            color: #333;
        }

        h2 {
            text-align: center;
            color: #007bff;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
        }

        input[type=\"text\"], input[type=\"date\"], select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type=\"submit\"] {
            margin-top: 20px;
            padding: 10px 15px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type=\"submit\"]:hover {
            background-color: #218838;
        }

        .error-message {
            color: red;
            margin-top: 10px;
            display: none;
        }

        select {
            appearance: none;
            background-size: 12px;
            padding-right: 30px;
        }
    </style>
</head>
<body>

<h2>Форма внесения данных в расписание поездок</h2>
<form id=\"scheduleForm\">
    <label for=\"region\">Регион:</label>
    <select id=\"region\" name=\"region\" onchange=\"calculateArrivalDate()\">
        <option value=\"\">Выберите регион</option>
        ";
        // line 78
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["regions"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["region"]) {
            // line 79
            yield "            <option value=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["region"], "regionName", [], "any", false, false, false, 79), "html", null, true);
            yield "\" data-duration=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["region"], "duration", [], "any", false, false, false, 79), "html", null, true);
            yield "\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["region"], "regionName", [], "any", false, false, false, 79), "html", null, true);
            yield " (";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["region"], "duration", [], "any", false, false, false, 79), "html", null, true);
            yield ")</option>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['region'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 81
        yield "    </select>

    <label for=\"departure\">Дата выезда из Москвы:</label>
    <input type=\"date\" id=\"departure\" name=\"departure\" required onchange=\"calculateArrivalDate()\">

    <label for=\"name\">ФИО курьера:</label>
    <input type=\"text\" id=\"name\" name=\"name\" required>

    <label for=\"arrivalDate\">Дата прибытия в регион:</label>
    <input type=\"text\" id=\"arrivalDate\" name=\"arrivalDate\" readonly>

    <input type=\"submit\" value=\"Отправить\">

    <div class=\"error-message\" id=\"error-message\"></div>
</form>

<script>
    function calculateArrivalDate() {
        const regionSelect = document.getElementById(\"region\");
        const departureDateInput = document.getElementById(\"departure\");
        const arrivalDateInput = document.getElementById(\"arrivalDate\");

        const selectedOption = regionSelect.options[regionSelect.selectedIndex];
        const travelDuration = selectedOption.getAttribute(\"data-duration\");

        if (selectedOption.value && departureDateInput.value) {
            const departureDate = new Date(departureDateInput.value);
            departureDate.setDate(departureDate.getDate() + Number(travelDuration));
            arrivalDateInput.value = departureDate.toISOString().split(\"T\")[0];
        } else {
            arrivalDateInput.value = \"\";
        }
    }

    document.getElementById(\"scheduleForm\").addEventListener(\"submit\", function(event) {
        event.preventDefault();

        const formData = {
            region: document.getElementById(\"region\").value,
            departure: document.getElementById(\"departure\").value,
            name: document.getElementById(\"name\").value
        };

        console.log(JSON.stringify(formData));

        fetch(window.location.origin +'/api/create_route', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(formData)
        })
            .then(response => {
                if (!response.ok) {
                    return response.text().then(text => {
                        throw new Error(text);
                    });
                }
                return response.json();
            })
            .then(data => {
                alert('Маршрут успешно создан.')
                document.getElementById(\"error-message\").textContent = \"\";
            })
            .catch(error => {
                document.getElementById(\"error-message\").textContent = error.message;
                document.getElementById(\"error-message\").style.display = 'block';
            });
    });
</script>

</body>
</html>";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "create_route.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable(): bool
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  140 => 81,  125 => 79,  121 => 78,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<!DOCTYPE html>
<html lang=\"ru\">
<head>
    <meta charset=\"UTF-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <title>Форма внесения данных в расписание</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
            color: #333;
        }

        h2 {
            text-align: center;
            color: #007bff;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
        }

        input[type=\"text\"], input[type=\"date\"], select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type=\"submit\"] {
            margin-top: 20px;
            padding: 10px 15px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type=\"submit\"]:hover {
            background-color: #218838;
        }

        .error-message {
            color: red;
            margin-top: 10px;
            display: none;
        }

        select {
            appearance: none;
            background-size: 12px;
            padding-right: 30px;
        }
    </style>
</head>
<body>

<h2>Форма внесения данных в расписание поездок</h2>
<form id=\"scheduleForm\">
    <label for=\"region\">Регион:</label>
    <select id=\"region\" name=\"region\" onchange=\"calculateArrivalDate()\">
        <option value=\"\">Выберите регион</option>
        {% for region in regions %}
            <option value=\"{{ region.regionName }}\" data-duration=\"{{ region.duration }}\">{{ region.regionName }} ({{ region.duration }})</option>
        {% endfor %}
    </select>

    <label for=\"departure\">Дата выезда из Москвы:</label>
    <input type=\"date\" id=\"departure\" name=\"departure\" required onchange=\"calculateArrivalDate()\">

    <label for=\"name\">ФИО курьера:</label>
    <input type=\"text\" id=\"name\" name=\"name\" required>

    <label for=\"arrivalDate\">Дата прибытия в регион:</label>
    <input type=\"text\" id=\"arrivalDate\" name=\"arrivalDate\" readonly>

    <input type=\"submit\" value=\"Отправить\">

    <div class=\"error-message\" id=\"error-message\"></div>
</form>

<script>
    function calculateArrivalDate() {
        const regionSelect = document.getElementById(\"region\");
        const departureDateInput = document.getElementById(\"departure\");
        const arrivalDateInput = document.getElementById(\"arrivalDate\");

        const selectedOption = regionSelect.options[regionSelect.selectedIndex];
        const travelDuration = selectedOption.getAttribute(\"data-duration\");

        if (selectedOption.value && departureDateInput.value) {
            const departureDate = new Date(departureDateInput.value);
            departureDate.setDate(departureDate.getDate() + Number(travelDuration));
            arrivalDateInput.value = departureDate.toISOString().split(\"T\")[0];
        } else {
            arrivalDateInput.value = \"\";
        }
    }

    document.getElementById(\"scheduleForm\").addEventListener(\"submit\", function(event) {
        event.preventDefault();

        const formData = {
            region: document.getElementById(\"region\").value,
            departure: document.getElementById(\"departure\").value,
            name: document.getElementById(\"name\").value
        };

        console.log(JSON.stringify(formData));

        fetch(window.location.origin +'/api/create_route', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(formData)
        })
            .then(response => {
                if (!response.ok) {
                    return response.text().then(text => {
                        throw new Error(text);
                    });
                }
                return response.json();
            })
            .then(data => {
                alert('Маршрут успешно создан.')
                document.getElementById(\"error-message\").textContent = \"\";
            })
            .catch(error => {
                document.getElementById(\"error-message\").textContent = error.message;
                document.getElementById(\"error-message\").style.display = 'block';
            });
    });
</script>

</body>
</html>", "create_route.html.twig", "/var/www/html/public/src/Templates/create_route.html.twig");
    }
}
