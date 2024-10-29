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

/* list.html.twig */
class __TwigTemplate_5a51f4ef28ce2cd3cadc1b19b983cd14 extends Template
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
    <title>Поездки курьеров</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            margin-bottom: 20px;
            text-align: center;
        }

        label {
            font-weight: bold;
            margin-right: 10px;
        }

        input[type=\"date\"] {
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            padding: 6px 12px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #218838;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ccc;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #e9ecef;
        }

        p {
            text-align: center;
            font-size: 16px;
            color: #555;
        }
    </style>
</head>
<body>
<h1>Форма поездок курьеров</h1>
<form id=\"dateForm\">
    <label for=\"date\">Выберите дату отправления курьера:</label>
    <input type=\"date\" id=\"date\" name=\"date\" required>
    <button type=\"submit\" id=\"submitButton\">Отобразить поездки</button>
</form>

<div id=\"tableContainer\">
    ";
        // line 89
        if ((array_key_exists("couriers", $context) && (Twig\Extension\CoreExtension::length($this->env->getCharset(), ($context["couriers"] ?? null)) > 0))) {
            // line 90
            yield "        <table>
            <thead>
            <tr>
                <th>Имя и ID Курьера</th>
                <th>ID маршрута</th>
                <th>Дата отправления</th>
                <th>Регион прибытия</th>
                <th>Треб. кол-во дней в пути</th>
            </tr>
            </thead>
            <tbody>
            ";
            // line 101
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["couriers"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["courier"]) {
                // line 102
                yield "                ";
                $context['_parent'] = $context;
                $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, $context["courier"], "routes", [], "any", false, false, false, 102));
                foreach ($context['_seq'] as $context["_key"] => $context["route"]) {
                    // line 103
                    yield "                    <tr>
                        <td>";
                    // line 104
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["courier"], "name", [], "any", false, false, false, 104), "html", null, true);
                    yield " (";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["courier"], "id", [], "any", false, false, false, 104), "html", null, true);
                    yield ")</td>
                        <td>";
                    // line 105
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["route"], "id", [], "any", false, false, false, 105), "html", null, true);
                    yield "</td>
                        <td>";
                    // line 106
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["route"], "departure", [], "any", false, false, false, 106), "m/d/Y"), "html", null, true);
                    yield "</td>
                        <td>";
                    // line 107
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["route"], "region", [], "any", false, false, false, 107), "regionName", [], "any", false, false, false, 107), "html", null, true);
                    yield "</td>
                        <td>";
                    // line 108
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["route"], "region", [], "any", false, false, false, 108), "duration", [], "any", false, false, false, 108), "html", null, true);
                    yield "</td>
                    </tr>
                ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_key'], $context['route'], $context['_parent']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 111
                yield "            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['courier'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 112
            yield "            </tbody>
        </table>
    ";
        } else {
            // line 115
            yield "        <p>Поездки не найдены для указанной даты.</p>
    ";
        }
        // line 117
        yield "</div>

<script>
    document.getElementById('dateForm').addEventListener('submit', function (event) {
        event.preventDefault();

        const date = document.getElementById('date').value;
        const submitButton = document.getElementById('submitButton');
        submitButton.disabled = true;

        fetch(window.location.origin + `/api/route/list/\${date}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Ошибка при запросе данных');
                }

                return response.json();
            })
            .then(data => {
                const tableContainer = document.getElementById('tableContainer');
                tableContainer.innerHTML = '';

                if (data && data.length > 0) {
                    const table = document.createElement('table');
                    table.innerHTML = `
                    <thead>
                        <tr>
                            <th>Имя и ID Курьера</th>
                            <th>ID маршрута</th>
                            <th>Дата отправления</th>
                            <th>Регион прибытия</th>
                            <th>Треб. кол-во дней в пути</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    `;
                    const tbody = table.querySelector('tbody');

                    data.forEach(record => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td>\${record.name} (\${record.courier_id})</td>
                            <td>\${record.route_id}</td>
                            <td>\${new Date(record.departure).toLocaleDateString('en-US')}</td>
                            <td>\${record.region_name}</td>
                            <td>\${record.duration}</td>
                        `;
                        tbody.appendChild(row);
                    });

                    tableContainer.appendChild(table);
                } else {
                    tableContainer.innerHTML = '<p>Поездки не найдены для указанной даты.</p>';
                }
            })
            .catch(error => {
                console.error('Ошибка:', error);
                const tableContainer = document.getElementById('tableContainer');
                tableContainer.innerHTML = '<p>Произошла ошибка при загрузке данных.</p>';
            })
            .finally(() => {
                submitButton.disabled = false;
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
        return "list.html.twig";
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
        return array (  201 => 117,  197 => 115,  192 => 112,  186 => 111,  177 => 108,  173 => 107,  169 => 106,  165 => 105,  159 => 104,  156 => 103,  151 => 102,  147 => 101,  134 => 90,  132 => 89,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<!DOCTYPE html>
<html lang=\"ru\">
<head>
    <meta charset=\"UTF-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <title>Поездки курьеров</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            margin-bottom: 20px;
            text-align: center;
        }

        label {
            font-weight: bold;
            margin-right: 10px;
        }

        input[type=\"date\"] {
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            padding: 6px 12px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #218838;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ccc;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #e9ecef;
        }

        p {
            text-align: center;
            font-size: 16px;
            color: #555;
        }
    </style>
</head>
<body>
<h1>Форма поездок курьеров</h1>
<form id=\"dateForm\">
    <label for=\"date\">Выберите дату отправления курьера:</label>
    <input type=\"date\" id=\"date\" name=\"date\" required>
    <button type=\"submit\" id=\"submitButton\">Отобразить поездки</button>
</form>

<div id=\"tableContainer\">
    {% if couriers is defined and couriers|length > 0 %}
        <table>
            <thead>
            <tr>
                <th>Имя и ID Курьера</th>
                <th>ID маршрута</th>
                <th>Дата отправления</th>
                <th>Регион прибытия</th>
                <th>Треб. кол-во дней в пути</th>
            </tr>
            </thead>
            <tbody>
            {% for courier in couriers %}
                {% for route in courier.routes %}
                    <tr>
                        <td>{{ courier.name }} ({{ courier.id }})</td>
                        <td>{{ route.id }}</td>
                        <td>{{ route.departure|date(\"m/d/Y\") }}</td>
                        <td>{{ route.region.regionName }}</td>
                        <td>{{ route.region.duration }}</td>
                    </tr>
                {% endfor %}
            {% endfor %}
            </tbody>
        </table>
    {% else %}
        <p>Поездки не найдены для указанной даты.</p>
    {% endif %}
</div>

<script>
    document.getElementById('dateForm').addEventListener('submit', function (event) {
        event.preventDefault();

        const date = document.getElementById('date').value;
        const submitButton = document.getElementById('submitButton');
        submitButton.disabled = true;

        fetch(window.location.origin + `/api/route/list/\${date}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Ошибка при запросе данных');
                }

                return response.json();
            })
            .then(data => {
                const tableContainer = document.getElementById('tableContainer');
                tableContainer.innerHTML = '';

                if (data && data.length > 0) {
                    const table = document.createElement('table');
                    table.innerHTML = `
                    <thead>
                        <tr>
                            <th>Имя и ID Курьера</th>
                            <th>ID маршрута</th>
                            <th>Дата отправления</th>
                            <th>Регион прибытия</th>
                            <th>Треб. кол-во дней в пути</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    `;
                    const tbody = table.querySelector('tbody');

                    data.forEach(record => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td>\${record.name} (\${record.courier_id})</td>
                            <td>\${record.route_id}</td>
                            <td>\${new Date(record.departure).toLocaleDateString('en-US')}</td>
                            <td>\${record.region_name}</td>
                            <td>\${record.duration}</td>
                        `;
                        tbody.appendChild(row);
                    });

                    tableContainer.appendChild(table);
                } else {
                    tableContainer.innerHTML = '<p>Поездки не найдены для указанной даты.</p>';
                }
            })
            .catch(error => {
                console.error('Ошибка:', error);
                const tableContainer = document.getElementById('tableContainer');
                tableContainer.innerHTML = '<p>Произошла ошибка при загрузке данных.</p>';
            })
            .finally(() => {
                submitButton.disabled = false;
            });
    });
</script>
</body>
</html>", "list.html.twig", "/var/www/html/public/src/Templates/list.html.twig");
    }
}
