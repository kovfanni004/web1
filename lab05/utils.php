<?php

// Utility funciton for creating HTML select elements
function generateNumericSelect($name, $from, $to)
{
    echo "<select name=\"$name\" class=\"form-select\">";
    for($i=$from;$i<=$to;$i++)
    {
        echo "<option value=\"$i\">$i</option>";
    }
    echo "</select>";
}

?>