<!DOCTYPE html>

<html lang="ru">
 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Задание 3</title>
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
                    <input type="radio" name="gender" value="Male" />Мужской
                </label>
                <label>
                    <input type="radio" name="gender" value="Female" />Женский
                </label>
                <label>
                    <input type="radio" name="gender" value="other" />Другое
                </label>
	    </div><br />

	    <div class="point">
                Количество конечностей:<br />
                <label>
                    <input type="radio" name="limbs" value="2" />2
                </label>
                <label>
                    <input type="radio" name="limbs" value="4" />4
                </label>
                <label>
                    <input type="radio" name="limbs" value="other" />Другое
                </label>
	    </div><br />
      
	    <div class="point">
                <label>
                    Сверхспособность:<br />
                    <select name="superpowers[]" multiple="multiple">
                        <option value="Immortality">Бессмертие</option>
                        <option value="Immateriality">Прохождение сквозь стены</option>
                        <option value="Levitation">Левитация</option>
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
