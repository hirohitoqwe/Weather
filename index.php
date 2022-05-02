<?php

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather</title>
</head>
<body>
<form method="post" action="handler.php">
    <select class="form-control" name="city">
        <option value="Москва">Москва</option>
        <option value="Казань">Казань</option>
        <option value="Новосибирск">Новосибирск</option>
        <option value="Санкт-Петербург">Санкт-Петербург</option>
        <option value="Владивосток">Владивосток</option>
    </select>
	<div class="col-sm-offset-2 col-sm-6">
			<button type="submit" id="submit" class="btn btn-primary">Отправить</button>
	</div>
</form>
</body>
</html>