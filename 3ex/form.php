<!DOCTYPE html>

<html lang="ru">
 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Задание 2</title>
</head>

<body>
    <header>
        <div class="head">Задание 3</div>
    </header>
 
    <div class="content">

        <form action="" method="POST">

	    <div class="point">
                <label>
                    Имя:<br />
                    <input name="name" value="" />
            	</label>
	    </div><br />

	    <div class="point">
                <label>
                    e-mail:<br />
                    <input name="email" value="" type="email" />
                </label>
	    </div><br />

	    <div class="point">
                <label>
                    Дата рождения:<br />
                    <input name="birthday" value="2019-08-13" type="date" />
                </label>
	    </div><br />
	    
	    <div class="point">
                Пол:<br />
                <label>
                    <input type="radio" checked="checked" name="gender" value="Значение1" />Мужской
                </label>
                <label>
                    <input type="radio" name="gender" value="Значение1" />Женский
                </label>
                <label>
                    <input type="radio" name="gender" value="Значение2" />Другое
                </label>
	    </div><br />

	    <div class="point">
                Количество конечностей:<br />
                <label>
                    <input type="radio" checked="checked" name="limbs" value="Значение1" />0
                </label>
                <label>
                    <input type="radio" name="limbs" value="Значение2" />4
                </label>
                <label>
                    <input type="radio" name="limbs" value="Значение2" />Другое
                </label>
	    </div><br />
      
	    <div class="point">
                <label>
                    Сверхспособность:<br />
                    <select name="superpowers[]" multiple="multiple">
                        <option value="Значение1">Бессмертие</option>
                        <option value="Значение2">Прохождение сквозь стены</option>
                        <option value="Значение3">Левитация</option>
                    </select>
                </label>
	    </div><br />

	    <div class="point">
                <label>
                    Биография:<br />
                    <textarea name="biography"></textarea>
                </label>
	    </div><br />

	    <div class="point">
                <label>
                    <input type="checkbox" name="contract" />С контрактом ознакомлен(а)
                </label>
	    </div><br />

	    <div class="point">
                <input class="button" type="submit" value="Отправить" />
	    </div>

        </form>
          
    </div>
 
</body>
 
</html>
