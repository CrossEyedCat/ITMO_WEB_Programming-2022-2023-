<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lab_1</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<header>
    <div class="head_title">Зенкевич Артем Андреевич P3212 Вариант:1210</div>
</header>
<?php
			session_start();
			if (!isset($_SESSION['counter'])) $_SESSION['counter']=0;
            		$_SESSION['counter']++;
        	?>
<div class="middle">
    <div class="target"><img class="target" src="/resources/images/target.png" alt="target"></div>
    <div class="menu">
        <h2>Стрельбище</h2>
        <h3>Настройка выстрела</h3>
        <form action ="index.php" method = "post">
            <div class="R_text">
                <h4>Значение R:</h4>

                <select class="R" id = "coord">
                    <option name = "paramR" selected value="1">1</option>
                    <option name = "paramR" value="2">2</option>
                    <option name = "paramR" value="3">3</option>
                    <option name = "paramR" value="4">4</option>
                    <option name = "paramR" value="5">5</option>
                </select>
                </div>
            <div class="X_text" id = "coord">
                <h4>Значение X:</h4>
                    <textarea class = "number" name="paramX"></textarea>
            </div>
            <div class="Y_text" id = "coord">
                <h4>Значение Y:</h4>
                    <textarea class = "number" name="paramY"></textarea>
            </div>
               <input type="submit" class="button">
        </form>
    </div>
</div>
<?php
			include 'script.php'; //определение попадания точки в область происходит здесь. ВАЖНО! в файле .html эта строка не будет работать
?>
<script>
function onlyDigits() {
      				this.value = this.value.replace(/[^\d\,\-]/g, "");//разрешаем ввод только цифр 0-9, запятой и минуса

          			if(this.value.lastIndexOf("-")> 0) {//если пользователь вводит тире (минус) не самым первым символом...
            				this.value = this.value.substr(0, this.value.lastIndexOf("-"));//то удаляем этот минус
          			}

        			if(this.value[0]== "-") {//если первый символ это минус (число отрицательно)...
            				if(this.value[1]== "4" || this.value[1]== "5" || this.value[1]== "6" || this.value[1]== "7" || this.value[1]== "8" || this.value[1]== "9"){
                				this.value = this.value.substr(0, 1);//то запрещаем вводить цифры 4,5,6,7,8,9
            				}
					if(this.value[1]== "3" && this.value[2]!=""){
                				this.value = this.value.substr(0, 2);//то запрещаем вводить число больше 0
            				}

            				if(this.value.length>2 && this.value[2]!=",") this.value=this.value[0]+this.value[1]+","+this.value[2];//если третий символ введён и он не запятая, то вставляем запятую между вторым и третим символом
            				if(this.value.length>8) this.value = this.value.substr(0, 8);//если количество символов равно 8 (5 знаков после запятой), не даём вводить больше
        			}else{//если число положительно (первым введён не минус, а цифра)...
            				if(this.value[0]== "," || this.value[0]== "6" || this.value[0]== "7" || this.value[0]== "8" || this.value[0]== "9"){
                				this.value = this.value.substr(0, 0);//то эта цифра должна быть от 0 до 5
            				}
					if(this.value[0]== "5" && this.value[1]!= ""){
                				this.value = this.value.substr(0, 1);//то эта цифра должна быть от 0 до 5
            				}

            				if(this.value.length>1 && this.value[1]!=",") this.value=this.value[0]+","+this.value[1];//если второй символ введён и он не запятая, то вставляем запятую между первым и вторым символом
            				if(this.value.length>7) this.value = this.value.substr(0, 7);//если количество символов равно 7 (5 знаков после запятой), не даём вводить больше
        			}

        			if(this.value.match(/\,/g).length > 1) {//не даём ввести больше одной запятой
            				this.value = this.value.substr(0, 0);
        			}

        			if(this.value.match(/\-/g).length > 1) {//не даём ввести больше одного минуса
            				this.value = this.value.substr(0, 0);
        			}
    			}
			//присваиваем данный скрипт нашему полю ввода
    			document.querySelector(".number").onkeyup = onlyDigits
</script>
<footer>
    <div class="foot_title">Зенкевич Артем Андреевич</div>
</footer>
</body>
</html>