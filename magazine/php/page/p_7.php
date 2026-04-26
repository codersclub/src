<?php

$site['page']['block_number_mag'] = '<div class="block_menu"><div class="text">
<h4>Сентябрь 2006</h4>
<b>Программирование:</b><br>
	&nbsp;&raquo;&nbsp;<a href="'. $site['setting']['base'] .'/0906/01.html">Создание игр на JavaScript</a><br>
	&nbsp;&raquo;&nbsp;<a href="'. $site['setting']['base'] .'/0906/02.html">Делаем свой "pak-explorer"</a><br>
	&nbsp;&raquo;&nbsp;<a href="'. $site['setting']['base'] .'/0906/03.html">Многомерная сортировка объектов</a><br>
	&nbsp;&raquo;&nbsp;<a href="'. $site['setting']['base'] .'/0906/04.html">Новостная лента на ASP.NET</a><br>
	&nbsp;&raquo;&nbsp;<a href="'. $site['setting']['base'] .'/0906/05.html">Красивые окна</a><br>
	&nbsp;&raquo;&nbsp;<a href="'. $site['setting']['base'] .'/0906/06.html">Красивый ListBox</a><br>
	&nbsp;&raquo;&nbsp;<a href="'. $site['setting']['base'] .'/0906/07.html">Красивый PopupMenu</a><br>
	&nbsp;&raquo;&nbsp;<a href="'. $site['setting']['base'] .'/0906/08.html">Программирование с<br>&nbsp;&nbsp;использованием DirectX9</a><br>
	&nbsp;&raquo;&nbsp;<a href="'. $site['setting']['base'] .'/0906/08_enclosure.html">Справочник использованных функций</a><br>
	<br><b>ПО:</b><br>
	&nbsp;&raquo;&nbsp;<a href="'. $site['setting']['base'] .'/0906/09.html">Создание личного веб-сервера</a><br>
	<br><b>Графика/дизайн:</b><br>
	&nbsp;&raquo;&nbsp;<a href="'. $site['setting']['base'] .'/0906/10.html">Реалистичные сигареты</a><br>
	&nbsp;&raquo;&nbsp;<a href="'. $site['setting']['base'] .'/0906/11.html">Собственный IcoSet</a><br>
	<div class=hr>&nbsp;</div>
	&nbsp;&raquo;&nbsp;<a href="'. $site['setting']['base'] .'/main/archive.html#0906offline">Off-line версия (архив)</a><br>
</div></div>';


switch ($site['page']['url']) {
case '0906/index.html':
	$site['page']['title'] .= ' - Сентябрь 2006';
	$site['page']['body'] = '<h1>Сентябрь 2006</h1>
<div class="block_menu"><div class="text">
<h2>Содержание</h2>
<h3>Программирование:</h3>
<ul>
<li><a href="'. $site['setting']['base'] .'/0906/index.html">Создание игр на JavaScript</a></li>
<li><a href="'. $site['setting']['base'] .'/0906/02.html">Делаем свой pak</a></li>
<li><a href="'. $site['setting']['base'] .'/0906/03.html">Многомерная сортировка</a></li>
<li><a href="'. $site['setting']['base'] .'/0906/04.html">Новостная лента на ASP.NET</a></li>
<li><a href="'. $site['setting']['base'] .'/0906/05.html">Красивые окна</a></li>
<li><a href="'. $site['setting']['base'] .'/0906/06.html">Красивый ListBox</a></li>
<li><a href="'. $site['setting']['base'] .'/0906/07.html">Красивый PopupMenu.</a></li>
<li><a href="'. $site['setting']['base'] .'/0906/08.html">Программирование с использованием DirectX9</a></li>
</ul>
<h3>ПО:</h3>
<ul>
<li><a href="'. $site['setting']['base'] .'/0906/09.html">Создание личного веб-сервера</a></li>
</ul>
<h3>Графика/дизайн:</h3>
<ul>
<li><a href="'. $site['setting']['base'] .'/0906/10.html">Реалистичные сигареты</a></li>
<li><a href="'. $site['setting']['base'] .'/0906/11.html">Собственный IcoSet</a></li>
</ul>
</div></div>
';
	break;
//-------------------------------------------------------------------------------------------------------

case '0906/01.html':
	$site['page']['title'] .= ' - Создание игр на JavaScript';
	$site['page']['description'] .= ' Создание игр на JavaScript';
	$site['page']['keywords'] .= ', Создание игр JavaScript, Создание JavaScript';
	$site['page']['body'] = '<h1>Создание игр на JavaScript</h1>

<b>Переводчик:</b> <a href="http://forum.sources.ru/index.php?showuser=4949"><i>vk</i></a>
<p>От Zanathel<br>
<i>«Передвижение белого квадрата по темному полю»</i></p>
<h2 Align=Center>Создайте Вашу первую игру на JavaScript!</h2>
<b>Введение.</b>
<p>JavaScript – очень мощный язык, гораздо более мощный, чем можно предположить.<br>
Я понял, на что способны скриптовые языки после того, как поэкспериментировал с обработчиками событий от клавиатуры и полной перерисовкой экрана в сжатые сроки.
В IE 5.0 я поставил перерисовку экрана каждые 10 милисекунд, и это не вызвало ни задержек, ни увеличения потребляемого объема памяти.
Когда я это увидел, я понял, что просто обязан углубиться в изучение JavaScript.
В результате получилась в чем-то простая, а в чем-то сложная игра, которая пользовалась успехом среди моих друзей.
Сейчас я собираюсь попытаться создать универсальную относительно браузера игру с дружественным интерфейсом.
Пусть семейство браузеров с открытым кодом представляет FireFox, как наиболее стандартный из них.</p><br>
<b>Тест.</b>
<p>Взгляните на нижеследующий код. Он корректно работает и в IE, и в FireFox. Что меня поразило, так это то, что FireFox по сравнению с IE предоставляет расширенную поддержку обработки событий:</p>

<pre class="code">&lt;!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0<br> Transitional//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"&gt;
&lt;html xmlns="http://www.w3.org/1999/xhtml"&gt;
&lt;head&gt;
&lt;meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /&gt;
&lt;title&gt;Browser hooking capabilities&lt;/title&gt;
&lt;script language="javascript" type="text/javascript"&gt;
&lt;!--
    var isIE = (String(typeof(document.all)) != "undefined");

    function keyhookDown(ev)
    {
        var key = new Number();
        if (isIE)
            key = event.keyCode;
        else
            key = ev.which;

        alert("Down: " + key.toString());
    }

    function keyhookUp(ev)
    {
        var key = new Number();
        if (isIE)
            key = event.keyCode;
        else
            key = ev.which;

        alert("Up: " + key.toString());
    }

    function prepareKeyHook()
    {
        document.onkeyup = keyhookUp;
        document.onkeydown = keyhookDown;
    }
--&gt;
&lt;/script&gt;
&lt;/head&gt;

&lt;body id="gSurface" onload="prepareKeyHook()" name="gSurface"&gt;

&lt;/body&gt;
&lt;/html&gt;
</pre>
<p>Это отличная новость.</p><br><b>Как все собрать.</b>
<p>&nbsp;&nbsp;&nbsp;&nbsp;Начинать следует с передвижения объекта (квадрата) по экрану. Для этого потребуются обработчики событий, передвигаемый объект, перерисовка экрана и система координат. Перед тем как создать систему координат, нужно получить реальные размеры клиентской области окна. В IE они хранятся в <i>document.body.offsetWidth</i> и <i>document.body.offsetHeight</i>. А как в Firefox? Воспользовавшись Google, я нашел свойства <i>window.innerWidth</i> и <i>window.innerHeight</i>. И все прекрасно работает.<br>&nbsp;&nbsp;&nbsp;&nbsp;Итак, высота и ширина системы координат определена. Теперь надо расположить наш объект точно в центре экрана. Как? Я попробовал разные способы, но наиболее подходящей мне показалась система позиционирования CSS. Перерисовывая конкретный участок экрана (ограниченный ячейкой таблицы), можно добиться высокой эффективности перерисовки.</p>
<br><b>Создание ядра</b><p>В обычных языках программирования Вы не перерисовываете постоянно весь экран. Вы перерисовываете конкретные участки (блиттинг). Эмуляция блиттинга в JavaScript заключается в том, что движущийся элемент располагается внутри отдельного слоя, который в общем случае может заполнять весь экран. Это позволяет не перерисовывать статические объекты, такие как дома, фон, статистика игры, сообщения и т.д. и спасает от мерцания картинки.</p>

<pre class="code">&lt;!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0<br> Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"&gt;
&lt;html xmlns="http://www.w3.org/1999/xhtml"&gt;
&lt;head&gt;
&lt;meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /&gt;
&lt;title&gt;Простой движущийся слой!&lt;/title&gt;
&lt;script language="javascript" type="text/javascript"&gt;
&lt;!--&lt;![CDATA[
    var surface = null;
    var SCREEN_X = 0, SCREEN_Y = 1;
    var bIE = (String(typeof(document.all)) != "undefined");
    var iMs = 25;

    //////////////////////////// Загрузка игры //////////////////////////
    function loadGame()
    {
        surface = document.getElementById("gSurface");

        if (surface == null)
        {
            alert("Не могу найти нужную поверхность!\nОтмена загрузки...");
            return;
        }
    }
//]]&gt;--&gt;
&lt;/script&gt;
&lt;style type="text/css" media="all"&gt;
&lt;!--&lt;![CDATA[
    html, body
    {
        width: 100%;
        height: 100%;

        padding: 0;
        margin: 0;

        overflow: hidden;
    }

    body
    {
        background-color: black;
    }

    #gSurface
    {
        position: relative;

        width: 100%;
        height: 100%;
    }
    #gBox
    {
        position: absolute;
        z-index: 2;

        width: 100px;
        height: 100px;
        background-color: white;
    }
/*]]&gt;*/--&gt;
&lt;/style&gt;
&lt;/head&gt;

&lt;body id="gContainer" onload="loadGame()"&gt;
    &lt;div id="gSurface"&gt;

    &lt;/div&gt;
&lt;/body&gt;
&lt;/html&gt;
</pre>
<p>ID тела документа – gContainer, а ID перерисовываемой поверхности – gSurface. Я также создал функцию, выполняющуюся всякий раз при загрузке страницы (не обновлении, а именно загрузке). В ней инициализируется передвигаемый слой (gBox).</p>
<br><b>Инициализация сцены</b>
<p>Мы хотим расположить объект точно в центре документа, поэтому нам нужны точные координаты. В этом случае нельзя использовать метод приближенного центрирования. Воспользуемся следующей формулой:</p>
<p>(ширина поверхности – ширина объекта)/2<br>(высота поверхности – высота объекта)/2</p>
<p>Перед тем как записать эту формулу на JavaScript, нужно определить класс движущегося объекта. Я назвал его «_box» (я ставлю символ подчеркивания в начале имен всех моих классов JavaScript). Он содержит x и y-координаты слоя, пропорции, скорость (в пикселях за такт) и параметры движения.</p>

<pre class="code">//////////////////////////// Классы ////////////////////////////
function _box(x, y, w, h, speed)
    {
        this.x = x;
        this.y = y;
        this.w = w;
        this.h = h;
        this.speed = speed;

        this.ix = false;
        this.dx = false;
        this.iy = false;
        this.dy = false;
}</pre>
<p>Ix, dx, iy и dy – флаги увеличения (increase) и уменьшения (decrease) координат x и y. Так как сначала объект должен покоиться, установим все четыре флага в false. Объект не движется ни вниз, ни вверх, ни влево, ни вправо.
<br>Теперь давайте напишем функцию, создающую движущийся объект. Для этого понадобится объявить глобальную переменную box.
</p>
<pre class="code">var surface = null, box = null;</pre>
<p>Объявив её, можно перейти к написанию функции:</p>
<pre class="code">//////////////////////////// Загрузка игры //////////////////////////
function prepareBox()
    {
        box = new _box(0, 0, 100, 100, 8);
        box.x = (getScreenSize(SCREEN_X) - box.w) / 2;
        box.y = (getScreenSize(SCREEN_Y) - box.h) / 2;
    }</pre>
<p>Если Вы новичок в объектно-ориентированном программировании на JavaScript, поясняю, что я определил экземпляр класса _box как переменную box. Параметрами конструктора являются начальные значения свойств. Обратиться к свойству созданного экземпляра можно посредством точки и имени нужного свойства.
<br>Как Вы могли заметить, я использовал ещё не определенную функцию getScreenSize. Нам нужно быстро получать размеры экрана, а так как соответствующие команды для разных браузеров различны, я решил выделить определение размеров в самостоятельную функцию:</p>
<pre class="code">//////////////////////////// Экран /////////////////////////////
function getScreenSize(s)
    {
        if (s == SCREEN_X)
        {
            if (bIE)
                return document.body.offsetWidth;

            return window.innerWidth;
        }
        else
        {
            if (bIE)
                return document.body.offsetHeight;

            return window.innerHeight;
        }
    }</pre>
<p>У нас есть класс движущегося объекта, функция для его создания и функция определения размеров экрана. Что осталось? Нужна функция, которая будет вызываться всеми нашими обрабтчиками событий, такими как OnKeyUp и OnKeyDown. Нужна также функция, которая будет вызываться каждые 25 милисекунд (это значение хранится в переменной iMs, см. второй листинг). Ну и, разумеется, нужна функция для вывода объекта на экран и передвижения его в целевую точку в соответствии с заданными параметрами движения.<br>
Начнем с методов-обработчиков событий. Расположим их перед функцией PrepareBox().</p>
<pre class="code">function attachEvents()
    {
        document.onkeydown = keyDown;
        document.onkeyup = keyUp;
    }
</pre>
<p>Просто? Да, но больше ничего и не требуется. Теперь надо обработать события клавиатуры:</p>
<pre class="code">//////////////////////////// Обработка событий клавиатуры ///////////////////////////
function keyDown(e)
    {
        switch ((bIE) ? event.keyCode : e.which)
        {
            case 37: // left
                box.ix = false;
                box.dx = true;
                break;
            case 38: // up
                box.iy = true;
                box.dy = false;
                break;
            case 39: // right
                box.ix = true;
                box.dx = false;
                break;
            case 40: // down
                box.iy = false;
                box.dy = true;
                break;
        }
    }

function keyUp(e)
    {
        switch ((bIE) ? event.keyCode : e.which)
        {
            case 37: // left
                box.dx = false;
                break;
            case 38: // up
                box.iy = false;
                break;
            case 39: // right
                box.ix = false;
                break;
            case 40: // down
                box.dy = false;
                break;
        }
    }</pre>
<p>А теперь позвольте мне пояснить приведеннй код, так как он может оказаться непрозрачным. Здесь я меняю параметры движения объекта. Когда пользователь нажимает на правую стрелку, х-координата объекта должна увеличиваться, а сам объект – двигаться от левой границы экрана к правой. Поэтому я отслеживаю нажатие 39-ой кнопки (это и есть правая стрелка), и как только она нажата, сбрасываю флаг уменьшения х-координаты (нам не нужно двигаться влево) и устанавливаю флаг её увеличения (двигаемся вправо). Прямо противоположные действия нужно осуществить по нажатию левой стрелки (37-ой кнопки).<br>
У-координата равна нулю в самом низу экрана. Если я хочу поднять объект вверх, я должен увеличивать у-координату. Для этого я устанавливаю флаг увеличения у-координаты (true) и сбрасываю флаг уменьшения (false).<br>
Так как я хочу, чтобы объект двигался только пока нажаты соответствующие кнопки, нужно сбрасывать все флаги, когда кнопку отпускают. Например, если я отпускаю верхнюю стрелку, то это означает, что я не хочу, чтобы объект продолжал двигаться вверх. Поэтому я сбрасываю флаг увеличения у-координаты, что немедленно остановит дальнейшее движение объекта вверх. Если в это время я продолжаю нажимать, например, левую стрелку, то движение влево не остановится, пока я и её не отпущу.<br>
А сейчас напишем функцию вывода объекта на экран! При изменении координат следует учитывать, что объект не должен выходить за пределы экрана.</p>
<pre class="code">//////////////////////////// Перерисовка /////////////////////
function printBox()
{
    if (box.ix)
    {
        if (box.x + box.w + box.speed <= getScreenSize(SCREEN_X))
            box.x += box.speed;
    }

    if (box.dx)
    {
        if (box.x - box.speed >= 0)
            box.x -= box.speed;
    }

    if (box.iy)
    {
        if (box.y + box.h + box.speed <= getScreenSize(SCREEN_Y))
            box.y += box.speed;
    }

    if (box.dy)
    {
        if (box.y - box.speed >= 0)
            box.y -= box.speed;
    }

    surface.innerHTML = <br>\'&lt;div id="gBox" style="left:\' + box.x + \'px;bottom:\' + box.y + \'px"&gt;&lt;/div&gt;\';
}
</pre>
<p>Система координат в HTML/CSS начинается в левом нижнем углу (см. рис. 1, «0»)</p>
<br>
<Table Align=Center border=0>
<TR>
	<TH>H</TH><TH>X</TH><TH>X</TH><TH>X</TH><TH>X</TH><TH>X</TH><TH>X</TH>
</TR>
<TR>
	<TH>X</TH><TH>X</TH><TH>X</TH><TH>X</TH><TH>X</TH><TH>X</TH><TH>X</TH>
</TR>
<TR>
	<TH>X</TH><TH>X</TH><TH>X</TH><TH>X</TH><TH>X</TH><TH>X</TH><TH>X</TH>
</TR>
<TR>
	<TH>X</TH><TH>X</TH><TH>X</TH><TH>X</TH><TH>X</TH><TH>X</TH><TH>X</TH>
</TR>
<TR>
	<TH>X</TH><TH>X</TH><TH>X</TH><TH>X</TH><TH>X</TH><TH>X</TH><TH>X</TH>
</TR>
<TR>
	<TH>O</TH><TH>X</TH><TH>X</TH><TH>X</TH><TH>X</TH><TH>X</TH><TH>W</TH>
</TR>
</Table>
<p Align=Center>Рис. 1 – Система координат</p>
<p>С помощью выражений «X > ширина экрана» и «У > высота экрана» не-возможно определить, что объект вышел за пределы  экрана. В этом случае объект будет останавливаться только тогда, когда границы экрана достигнет его точка «0» (см. рис. 1). Чтобы объект останавливался по достижении границ экрана точ-ками «H» и «W», нужно добавлять к координате Х в условиях остановки высоту и ширину объекта. То есть, вместо «Х > ширина экрана» используем «W > ширина экрана». Тогда никакая часть объекта не покинет область рисования. Передвинув координаты объекта, выведем его как слой. Заметьте, что я значительно сократил код, поместив всю статическую информацию об объекте в тег style.</p>
<p>Мы почти достигли финала! Остался последний шаг. Нужна функция, которая будет вызываться через определенный интервал (25 милисекунд). После этого нужно будет вызвать все написанные функции в теле функции loadGame(), которая пока пуста.</p>
<pre class="code">function updateScreen()
{
	surface.innerHTML = \'\';
	printBox();
    window.setTimeout(\'updateScreen()\', iMs);
}
</pre>
<p>Очистим поверхность и выведем новый объект. Повторяйте все время! А теперь – последний штрих!</p>
<pre class="code">function loadGame()
{
    surface = document.getElementById("gSurface");
    if (surface == null)
    {
    alert("Can\'t find the required surface!\nCancelling...");
    return;
    }
    attachEvents();
    prepareBox();
    updateScreen();
}</pre>
<p>Мы отследили все события, подготовили объект к движению (поместили его в центр экрана и инициализировали глобальную переменную для дальнейшего использования) и вызвали бесконечно повторяющуюся функцию updateScreen().
<br>Вот готовый код:</p>
<pre class="code">&lt;!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0<br> Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"&gt;
&lt;html xmlns="http://www.w3.org/1999/xhtml"&gt;
&lt;head&gt;
&lt;meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /&gt;
&lt;title&gt;Простой движущийся слой!&lt;/title&gt;
&lt;script language="javascript" type="text/javascript"&gt;
&lt;!--&lt;![CDATA[
    var box = null, surface = null;
    var SCREEN_X = 0, SCREEN_Y = 1;
    var bIE = (String(typeof(document.all)) != "undefined");
    var iMs = 25;

    //////////////////////////// Классы ////////////////////////////
    function _box(x, y, w, h, speed)
    {
        this.x = x;
        this.y = y;
        this.w = w;
        this.h = h;
        this.speed = speed;

        this.ix = false;
        this.dx = false;
        this.iy = false;
        this.dy = false;
    }

    //////////////////////////// Экран /////////////////////////////
    function getScreenSize(s)
    {
        if (s == SCREEN_X)
        {
            if (bIE)
                return document.body.offsetWidth;

            return window.innerWidth;
        }
        else
        {
            if (bIE)
                return document.body.offsetHeight;

            return window.innerHeight;
        }
    }

    //////////////////////////// Перерисовка /////////////////////
    function printBox()
    {
        if (box.ix)
        {
            if (box.x + box.w + box.speed &lt;= getScreenSize(SCREEN_X))
                box.x += box.speed;
        }

        if (box.dx)
        {
            if (box.x - box.speed &gt;= 0)
                box.x -= box.speed;
        }

        if (box.iy)
        {
            if (box.y + box.h + box.speed &lt;= getScreenSize(SCREEN_Y))
                box.y += box.speed;
        }

        if (box.dy)
        {
            if (box.y - box.speed &gt;= 0)
                box.y -= box.speed;
        }

        surface.innerHTML = <br>\'&lt;div id="gBox" style="left:\' + box.x + \'px;bottom:\' + box.y + \'px"&gt;&lt;/div&gt;\';
    }

    function updateScreen()
    {
        surface.innerHTML = \'\';

        printBox();
        window.setTimeout(\'updateScreen()\', iMs);
    }

    //////////////////////////// События ///////////////////////////
    function keyDown(e)
    {
        switch ((bIE) ? event.keyCode : e.which)
        {
            case 37: // влево
                box.ix = false;
                box.dx = true;
                break;
            case 38: // вверх
                box.iy = true;
                box.dy = false;
                break;
            case 39: // вправо
                box.ix = true;
                box.dx = false;
                break;
            case 40: // вниз
                box.iy = false;
                box.dy = true;
                break;
        }
    }

    function keyUp(e)
    {
        switch ((bIE) ? event.keyCode : e.which)
        {
            case 37: // влево
                box.dx = false;
                break;
            case 38: // вверх
                box.iy = false;
                break;
            case 39: // вправо
                box.ix = false;
                break;
            case 40: // вниз
                box.dy = false;
                break;
        }
    }

    //////////////////////////// Загрузка игры //////////////////////////
    function prepareBox()
    {
        box = new _box(0, 0, 100, 100, 8);
        box.x = (getScreenSize(SCREEN_X) - box.w) / 2;
        box.y = (getScreenSize(SCREEN_Y) - box.h) / 2;
    }

    function attachEvents()
    {
        document.onkeydown = keyDown;
        document.onkeyup = keyUp;
    }

    function loadGame()
    {
        surface = document.getElementById("gSurface");

        if (surface == null)
        {
            alert("Не могу найти нужную поверхность!\nОтмена загрузки...");
            return;
        }

        attachEvents();
        prepareBox();
        updateScreen();
    }
//]]&gt;--&gt;
&lt;/script&gt;
&lt;style type="text/css" media="all"&gt;
&lt;!--&lt;![CDATA[
    html, body
    {
        width: 100%;
        height: 100%;

        padding: 0;
        margin: 0;

        overflow: hidden;
    }

    body
    {
        background-color: black;
    }

    #gSurface
    {
        position: relative;

        width: 100%;
        height: 100%;
    }
    #gBox
    {
        position: absolute;
        z-index: 2;

        width: 100px;
        height: 100px;
        background-color: white;
    }
/*]]&gt;*/--&gt;
&lt;/style&gt;
&lt;/head&gt;

&lt;body id="gContainer" onload="loadGame()"&gt;
    &lt;div id="gSurface"&gt;

    &lt;/div&gt;
&lt;/body&gt;</pre>
<p>Наслаждайтесь!</p>
<p style="text-align: right;"><i>С уважением, <a href="http://forum.sources.ru/index.php?showuser=4949" target="_blank">vk</a>!</i></p>
';
	break;
//-------------------------------------------------------------------------------------------------------

case '0906/02.html':
	$site['page']['title'] .= ' - Делаем свой Pak-explorer';
	$site['page']['description'] .= ' Делаем свой Pak-explorer';
	$site['page']['keywords'] .= ', Pak-explorer';
	$site['page']['body'] = '<h1>Делаем свой "Pak-explorer"</h1>
<b>Автор:</b> <a href="http://forum.sources.ru/index.php?showuser=14566"><i>Seriy-Coder</i></a>
<h2>Предисловие</h2>
<p>Статья наша будет посвящена такому небезызвестному формату файлов как .pak. Собственно, этот формат был придуман id Software™ еще в далеком 1996 году, когда они разрабатывали движок игры. Файлы данного формата представляют собой некий пакет файлов. Упаковка файлов, включаемых в .pak, отсутствует. Разрабатывался формат для легкого и быстрого доступа из движка игры к необходимым файлам, находящимся «снаружи». Должен сказать, что он используется не только в Quake I, он нашел свое применение и в Quake II, Half-Life и некоторых других играх, сделанных на основе движка Quark.<br>
После, в 1997 году, была написана программа под названием Pak Explorer. Она позволяла просматривать  и модифицировать содержимое .pak файлов прямо внутри редактора.</p>
<br><p>А чем же займемся мы с вами? А займемся мы созданием программы под названием «Pak-Explorer Ex» (от слова Extended – расширенный).</p>

<h2>Основы.</h2><p>Перво-наперво мы определим, какие функции должна выполнять наша программа. Естественно, раз уж мы задались целью написать расширенный Pak-Explorer, необходимо сначала реализовать функции оригинальной программы, а именно:</p>
<br><li>Открывать и создавать .pak файлы</li>
<li>Редактировать .pak файлы (удалять\добавлять файлы)</li>
<li>"Быстро" просматривать файлы в .pak файле (например, проигрывать wav-файлы прямо в программе)</li>
<li>Обеспечивать поддержку Drag’n’Drop</li>

<br><p>А теперь определим множество расширенных функций:</p><br>
<li>Синхронизация (если изменяются оригиналы файлов в папке, программа предлагает заменить их в .pak файле)</li>
<li>Возможность удалять «в корзину» (иногда это бывает полезно, если вы вдруг удалили не тот файл, а он был в единственном экземпляре)</li>
<li>Поддержка отмены выполненных действий (Ctrl+Z)</li>
<br>
<p>С функциями разобрались. Теперь приступим к реализации.</p>
<p>Запускаем Visual Basic. В меню выбора проекта выбираем Standart Exe. Подключаем к проекту следующие контролы: Microsoft Common Dialog Control 6.0 и Microsoft Windows Common Controls 6.0 (правый щелчок мыши на панели инструментов toolbox, пункт меню Components). Размещаем на форме компоненты TreeView, ListView, ToolBar, ImageList и CommonDialog как показано на рисунке. Дерево каталогов принято размещать слева (для простоты навигации), хотя вы можете разместить его так, как вам будет угодно. Имена объектов также указаны на рисунке:</p>
<div align="center"><img src="'. $site['setting']['base'] .'/img/m/0906/02/1.jpg" border="0"></div>
<p>Далее следует таблица для создания меню. Для наглядности и удобства принято создавать меню в подобном стиле. Вы можете заметить, что практически во всех программах пункт меню, обозначенный как Edit, отвечает за редактирование, а его подменю Paste за вставку, например, текста из буфера обмена. Я тоже постарался следовать этому негласному правилу. Единственное отличие, которое вы увидите – это подменю Sinchronize Files меню Edit. Оно будет отвечать за синхронизацию файлов в .pak файле и в директории (например, заменять старые файлы на новые), и кажется логичным поместить его именно в это меню.</p>
<br><div align="center"><i>Таблица 1. Элементы меню.</i></div>
<table align="center" border="0">
<TR><TH><i>&nbsp;Caption (Заголовок эл-та меню)&nbsp;</i></TH><TH><i>&nbsp;Name (Имя эл-та меню)&nbsp;</i></TH></TR>
<TR><TH>&File</TH><TH>mnuFile</TH></TR>
<TR><TH>Подменю &New Pak</TH><TH>mnuNew</TH></TR>
<TR><TH>Подменю &Open Pak</TH><TH>mnuOpen</TH></TR>
<TR><TH>Подменю &Save Pak</TH><TH>mnuSave</TH></TR>
<TR><TH>Подменю Save Pak &As...</TH><TH>mnuSaveAs</TH></TR>
<TR><TH>Подменю -</TH><TH>Sep1</TH></TR>
<TR><TH>Подменю &Quit</TH><TH>mnuExit</TH></TR>
<TR><TH>&Edit</TH><TH>mnuEdit</TH></TR>
<TR><TH>Подменю Co&py</TH><TH>mnuCopy</TH></TR>
<TR><TH>Подменю C&ut</TH><TH>mnuCut</TH></TR>
<TR><TH>Подменю &Paste</TH><TH>mnuPaste</TH></TR>
<TR><TH>Подменю &Delete</TH><TH>mnuDel</TH></TR>
<TR><TH>Подменю -</TH><TH>Sep2</TH></TR>
<TR><TH>Подменю S&inchronize Files</TH><TH>mnuSinc</TH></TR>
</Table>

<p>Для красивого выравнивания объектов на форме при изменениях размера формы потребуется установить у объекта Toolbar свойство Align = 1 (vbAlignTop). У остальных видимых объектов свойство Align отсутствует, поэтому необходимо написать код, который будет их выравнивать. Код этот помещается в обработчик события Form_Resize(), которое происходит при изменении размера формы.</p>
<pre class="code">
On Error Resume Next
Tree1.Move 0, tbr1.Height, 1935, ScaleHeight - tbr1.Height
List1.Move Tree1.Width + 100, tbr1.Height, ScaleWidth - (Tree1.Width + 100), _
ScaleHeight - tbr1.Height
</pre>
<p>Первая строка «защищает» от ошибки, происходящей при сильном уменьшении размеров формы (когда высота формы меньше высоты ToolBar’a). Дерево каталогов размещается ниже панели инструментов ровно на ее высоту, слева отступа нет, в высоту растягиваем на высоту формы минус высоту панели инструментов. Единственная постоянная величина – ширина дерева. Лист размещается на той же высоте, с отступом влево на ширину дерева, а ширину листа вычисляем путем вычитания ширины дерева из ширины формы. Высота аналогична высоте дерева (вычисляется тем же способом).</p>
<br>
<p>Теперь я опишу формат самого файла, с которым предстоит работать. Вначале идет заголовок (12 байт), который состоит из трех полей по 4 байта. Первое поле содержит строку PACK, идентифицирующую данный формат (ее будем использовать для проверки открываемых файлов на правильность). Следующие четыре байта – это смещение каталога ресурсов относительно Pak-файла, а последние четыре – размер каталога в записях (то есть, количество ресурсов). Вот как это выглядит на VB:</p>
<pre class="code">Private Type pakheader_t
    magic       As String * 4   ‘ заголовок PACK
    diroffset   As Long         ‘ смещение каталога ресурсов
    dirsize     As Long         ‘ размер каталога
End Type
</pre>
<p>Сам каталог всегда находится в конце файла. Формат каждой записи следующий (каждая запись представляет файл, который содержится в .pak файле):</p>
<pre class="code">Private Type pakentry_t
    filename    As String * 56	‘ имя записи (имя и путь к файлу)
    offset      As Long          	‘ смещение (ГДЕ находятся данные)
    size   As Long             	‘ размер данных (размер файла)
End Type</pre>
<p>Поле filename содержит имя файла, включая путь к нему. Следующий параметр offset указывает смещение ресурса относительно начала Pak-файла. А параметр size указывает размер этого ресурса.</p>
<br><p>Итак, теперь есть типы, с помощью которых можно работать с .pak файлами. Приступим к реализации первой возможности программы, а именно, к возможности:</p>
<br><li>Открывать и создавать .pak файлы</li>
<p>Начнем с реализации возможности создания .pak файла.<br>
Создадим новый модуль (Project->AddModule), назовем его mMain, и будем помещать в него основные функции.<br><br>

Конкретно за создание будет отвечать одна маленькая функция:
</p>
<pre class="code">Public Function CreatePAK(ByVal filename As String) As Boolean
Dim FFe As Integer

FFe = FreeFile
PakHeader.magic = "PACK"
PakHeader.diroffset = 12
PakHeader.dirsize = 0

On Error GoTo err_h
If Dir(filename, vbNormal) <> "" Then Kill filename
Open filename For Binary As #FFe Len = Len(PakHeader)
    Put #FFe, , PakHeader
Close #FFe

CreatePAK = True
Exit Function
err_h:
CreatePAK = False
End Function</pre>
<p>Передаваемый параметр – это есть полное имя и путь к .pak файлу (например “c:\newpack.pak”). Заполняем структуру PakHeader (о которой говорилось чуть выше) «правильными» значениями, а именно: заголовок “PACK”, смещение = 12 (так как сам заголовок «весит» 12 байт), размер каталога = 0 (потому что ничего там ещё нет). Проверяем, нету ли такого же файла, а если есть – удаляем его. Открываем файл для двоичного (Binary) доступа и смело пишем всю структуру PakHeader в него. Все. Закрываем файл, функция возвращает True.<br><br>
Пойдем дальше. Надо уметь открывать файлы формата .pak…</p>
<pre class="code">Public Function OpenPAK(ByVal filename As String) As Boolean
Dim FFe As Integer, loopvar As Integer, curentry As Integer
Dim ReadString As String * 64
FFe = FreeFile
Open filename For Random As #FFe Len = Len(PakHeader)
Get #FFe, , PakHeader
Close #FFe
If PakHeader.magic <> "PACK" Then
    FFe = MsgBox("Invalid Pack File", vbOKOnly + vbInformation)
    OpenPAK = False
    Exit Function
End If

ReDim Preserve StoreEntry((PakHeader.dirsize / 64))
FFe = FreeFile
curentry = 1
Open filename For Binary As #FFe
Get #FFe, PakHeader.diroffset + 1, PakEntry
For loopvar = 1 To ((PakHeader.dirsize / 64))
    StoreEntry(curentry).filename = PakEntry.filename
    StoreEntry(curentry).offset = PakEntry.offset
    StoreEntry(curentry).size = PakEntry.size
    curentry = curentry + 1
    Get #FFe, , PakEntry
Next
Close #FFe
orig_filename = filename
OpenPAK = True
End Function</pre>
<p>Эта функция должна сделать 2 вещи: проверить, правильный ли файл открывается, а если да, то заполнить массив StoreEntry(), который-то и хранит данные о файлах в .pak файле. Итак, для начала читаем заголовок (PakHeader). С помощью инструкции Get #FFe, PakHeader заполняем структуру данными, а затем проверяем PakHeader.magic, соответствует ли файл формату "PACK". Если нет, говорим, что формат неправильный и выходим из функции. Если формат правильный, то заполняем массив StoreEntry данными о находящихся в .pak’e файлах:</p>
<pre class="code">ReDim Preserve StoreEntry((PakHeader.dirsize / 64))</pre>
<p>Переопределяем массив согласно количеству реально находящихся файлов в .pak’e:</p>
<pre class="code">Open filename For Binary As #FFe
Get #FFe, PakHeader.diroffset + 1, PakEntry
</pre><p>Открываем повторно файл, считываем первое «вхождение».</p>
<pre class="code">For loopvar = 1 To ((PakHeader.dirsize / 64))
    StoreEntry(curentry).filename = PakEntry.filename
    StoreEntry(curentry).offset = PakEntry.offset
    StoreEntry(curentry).size = PakEntry.size
    curentry = curentry + 1
    Get #FFe, , PakEntry
Next</pre>
<p>Теперь бегаем по всем «вхождениям», считываем их и соответственно заполняем поля массива данными.
Вот и все. Считали.<br><br>

Остальные функции используем для заполнения данными TreeView и ListView.<br>
Следующие процедуры хорошо откомментированы, советую с ними ознакомиться самостоятельно:<br><br>

Процедура заполнения дерева каталогов:
</p>

<pre class="code">Sub ShowEntry(TV As TreeView)
  On Error Resume Next
  Dim TP2() As String
  Dim i&, j&
  Dim TMP$
  Dim ParentKey$

TV.Nodes.Add , tvwFirst, "ROOT", orig_filename, 3
\' Добавляем самый верхний, корневой элемент с именем открываемого .pak файла
  \' Бегаем по всем файлам в .pak файле
  For i = 0 To UBound(StoreEntry)
    \' Берем только путь, отделяя имя файла
    TMP = GetPath(StoreEntry(i).filename)
    \' если в строке есть символ «/», значит, имеем несколько вложенных папок
    If InStr(TMP, "/") > 0 Then
      \' разбиваем на подпапки
      TP2 = Split(TMP, "/")
      ParentKey = vbNullString
      \' добавляем первую
      TV.Nodes.Add "ROOT", tvwChild, TP2(0), TP2(0), 1, 2
      \' запоминаем предыдущую папку
      ParentKey = TP2(0)
      For j = 1 To UBound(TP2)
        TMP = TP2(j)
        \' «вкладываем» папку в предыдущую
        TV.Nodes.Add ParentKey, tvwChild, ParentKey & TMP & "\", TMP, 1, 2
        ParentKey = ParentKey & TMP & "\"
      Next
    Else
    \' не имеем вложенных, добавляем к корневой
      If TMP <> vbNullString Then TV.Nodes.Add "ROOT", tvwChild, TMP, TMP, 1, 2
    End If
  Next
End Sub</pre>
<p>Процедура показа файлов в листе. Передаваемый параметр должен содержать путь внутри .pak файла.</p>
<pre class="code">Public Sub ShowFilesEntry(ByVal path As String)
Dim i As Long, l As Long, TMP As String
fMain.List1.ListItems.Clear
\' если длина пути НЕ равна длине оригинального пути имени файла (эта проверка
\' необходима, так как корневой каталог в дереве TreeView назван
\' оригинальным именем файла)

If Len(path) <> Len(orig_filename) Then
    \' «отделяем» оригинальный путь и имя файла от нужного
    path = Right$(path, Len(path) - (Len(orig_filename) + 1))
    \' теперь «пробегаем» по всем «файлам» в .pak файле
    For i = LBound(StoreEntry) + 1 To UBound(StoreEntry)
    \' если в имени файла текущего StoreEntry встречается наш путь, то
    If InStr(1, StoreEntry(i).filename, path) <> 0 Then
        \' проверяем еще раз, на всякий случай, по длине
        If Len(GetPath(RemoveStuff(StoreEntry(i).filename))) = Len(path) Then
            \' добавляем в лист файл
            AddFile GetNam(StoreEntry(i).filename), _
            StoreEntry(i).size
        End If
    End If
    Next i
Else
    \' теперь «пробегаем» по всем «файлам» в .pak файле
    For i = LBound(StoreEntry) + 1 To UBound(StoreEntry)
    \' если в имени файла не содержится обратных слешей, значит,
    \' файл лежит в корневой
директории)
    If InStr(1, RemoveStuff(StoreEntry(i).filename), "/") = 0 Then
       \' опять проверяем на длину и добавляем в список
            AddFile RemoveStuff((StoreEntry(i).filename)), _
            StoreEntry(i).size
    End If
    Next i
End If
End Sub</pre>
<p>Данная процедура добавляет элемент в List:</p>
<pre class="code">\' тут просто добавляем в лист имена файлов и их размер
Private Sub AddFile(ByVal file As String, ByVal size As Long)
    fMain.List1.ListItems.Add , , file
\' для удобства вычисляем размер файлов и показываем единицу размерности (Kb или b)
If size &lt;= 1024 Then
    fMain.List1.ListItems(fMain.List1.ListItems.Count) _
    .ListSubItems.Add , , size & " b"
ElseIf size &gt; 1024 Then
    fMain.List1.ListItems(fMain.List1.ListItems.Count) _
    .ListSubItems.Add  , , size \ 1024 & " Kb"
End If
End Sub</pre>
<p>Ну вот, теперь программа может открывать .pak файлы и просматривать их содержимое. В следующей статье добавим возможность редактировать (то есть, удалять\добавлять) .pak файлы.</p>

<br><hr>
<b>Скачать исходник:</b> <a href="'. $site['setting']['base'] .'/img/m/0906/02/pak.zip">pak.zip</a>&nbsp;(10 кб)
<p style="text-align: right;"><i>С уважением, <a href="http://forum.sources.ru/index.php?showuser=14566" target="_blank">Seriy-Coder</a>!</i></p>';
	break;
//-------------------------------------------------------------------------------------------------------

case '0906/03.html':
	$site['page']['title'] .= ' - Многомерная сортировка объектов. Сортировка с уступкой';
	$site['page']['description'] .= ' Многомерная сортировка объектов. Сортировка с уступкой.';
	$site['page']['keywords'] .= ', сортировка объектов, Сортировка уступкой';
	$site['page']['body'] = '<h1>Многомерная сортировка объектов. Сортировка с уступкой</h1>
<b>Автор:</b> <a href="http://forum.sources.ru/index.php?showuser=4949"><i>vk</i></a>
<p>Рассматривается классическая векторная (многомерная) сортировка объектов в пространстве разноприоритетных признаков, в том числе сортировка с уступкой в пользу признака с некорректным приоритетом. Обсуждаются проблемы классического подхода. Предлагается модифицированный алгоритм векторной сортировки и его простая программная реализация.</p>
<br><b>Введение.</b>
<p>Простейшим случаем упорядочения объектов с целью выбора наилучшего является сортировка по некоторому признаку, общему для всех объектов. К сожалению, в реальных задачах зачастую присутствует не один, а множество признаков, каждый из которых следует учитывать при сортировке. Пусть имеется множество объектов X={x<sub>1</sub>,…x<sub>i</sub>,…x<sub>n</sub>}, характеризующихся множеством признаков Y={y<sub>1</sub>,…y<sub>j</sub>,…y<sub>m</sub>}, измеренных в порядковой или более сильной шкале. Пусть для каждого признака можно указать направление оптимизации: максимизация (чем больше, тем лучше) или минимизация (чем меньше, тем лучше). Пусть также имеется возможность строго упорядочить признаки по значимости от самого приоритетного до наименее приоритетного. Если задача удовлетворяет всем перечисленным требованиям, может быть применен метод векторной сортировки.</p>
<h2 Align=Center>Алгоритм векторной сортировки</h2>
<p><b><i>Классический алгоритм векторной сортировки</i></b> заключается в последовательном переборе признаков, начиная с самого приоритетного и заканчивая наименее приоритетным.</p>

<ol>
<li>p=1, rang(x<sub>i</sub>)=1 для i=1..n</li>
<li>Объекты, имеющие на текущем шаге одинаковый ранг, сортируются по j-ому признаку, чей приоритет равен p</li>
<li>Если после использования признака j получены строгие ранги объектов, работа алгоритма завершается. В противном случае осуществляется переход к следующему по приоритету признаку (p++) и повторение П.2 до тех пор, пока не будут использованы все имеющие значение признаки</li>
<li>Если результаты ранжировки не удовлетворяют некоторым заранее определенным показателям качества решения, следует использовать уступку в пользу того признака, значения которого у выбранных объектов (получивших s<n первых мест) оказались наименее приемлемы. Уступка x% в пользу признака с приоритетом p>1 заключается в том, что значения признака c приоритетом p-1, отличающиеся менее чем на х%, считаются равными. Это дает возможность объектам, лучшим по признаку c приоритетом p, но не по признаку с приоритетом p-1 получить более высокий ранг.</li>
</ol>

<u><b>Пример 1. Многомерная сортировка автомобилей по ходовым характеристикам</b></u> (взято из студенческой лабораторной работы)
<br><br><div align="center"><i>Таблица 1. Многомерная сортировка без уступки</i></div>
<div align="center"><img src="'. $site['setting']['base'] .'/img/m/0906/03/1.png" border="0"></div>
<p>а<sub>i</sub> – автомобиль, п<sub>j</sub> – одна из четырех ходовых характеристик (объем двигателя, мощность, привод, грузоподъемность). Направления оптимизации всех признаков – максимизация. Пусть приоритеты признаков следующие: объем двигателя (п<sub>1</sub>) – 1, мощность (п<sub>2</sub>) – 2, привод (п<sub>3</sub>) – 2,  грузоподъемность (п<sub>4</sub>) – 4. Табл. 1 иллюстрирует пошаговое применение алгоритма многомерной сортировки. На первом шаге осуществляется сортировка по признаку п1 (объем двигателя). Полученные ранги показаны в столбце r1. Несколько объектов получили уникальные ранги, но общая сортировка нестрогая. Неразличимые на первом шаге ранги выделены, они бдут детализированы далее. На втором шаге (сортировка по приводу) уникальные ранги получают ранее неразличимые объекты a<sub>20</sub> и a<sub>5</sub>, а четыре объекта, получившие на первом шаге 11 ранг, разделяются на две группы неразличимых объектов. Сортировка по признаку п<sub>3</sub> (привод) не вносит в ранжировку никаких изменений. Окончательная строгая сортировка получается только на последнем шаге. Для удобства рассмотрения алгоритма в примере ранги объектов на каждом шаге не пересчитываются, а детализируются дополнительным рангом (через точку). Пересчет рангов в привычную шкалу производится после окончания работы алгоритма.</p>
<br><div align="center"><i>Таблица 2. Многомерная сортировка с уступкой</i></div>
<div align="center"><img src="'. $site['setting']['base'] .'/img/m/0906/03/2.png" border="0"></div>
<p>Пусть в пользу признака «Мощность» (п<sub>2</sub>, второй по приоритету) осуществляется уступка в 25% от шкалы предыдущего признака (объем двигателя, п<sub>1</sub>). Это означает, что значения признака п<sub>1</sub>, отличающиеся менее чем на 25% от шкалы [25%(6-1.2)=1.2], будут считаться равными. За счет этого применение многомерной сортировки даст другие результаты.</p>
<p>Классический вариант использования уступки предполагает отсчет от экстремальных значений. Шкала признака разбивается на d=100/x% интервалов длиной в значение уступки dx=x%(max-min). Объекты, попавшие в интервал [max-dx,max], получают ранг 1, объекты, попавшие в [max-2*dx,max-dx] – ранг 2, и т.д, до объектов, попавших в [min,min+dx] и получивших ранг d. В примере шкала признака п<sub>1</sub> разбита на 4 интервала, значения, принадлежащие одному интервалу, покрашены одним цветом, а соответствующие объекты получили одинаковый ранг. Далее многомерная сортировка идет обычным способом. Для наглядности помимо ранжировки объектов с уступкой в таблице приведена и обычная ранжировка, в отсутствие уступки. Видно, что часть объектов изменила свой ранг.</p>
<br><h2 align="center">Проблемы классического подхода. Модифицированный алгоритм</h2>
<p><b><i>Классический вариант</i></b> многомерной сортировки реализуется <b><i>рекурсивной функцией</i></b>, на каждом уровне рекурсии сортируется множество объектов, получивших одинаковый ранг на предыдущем уровне. Такой способ хорош тем, что алгоритм реализуется буквально – осуществляется перебор признаков и анализ всего множества объектов на каждом шаге. Недостатки такого способа реализации – в неоправданном применении рекурсии и большом числе сравнений. Кроме того, можно выделить ещё один недостаток на уровне алгоритма. В процессе сортировки объектов по уступающему признаку возникает ситуация, аналогичная <b><i>парадоксу «Лысый»</i></b>. В самом деле (см. пример 1, табл. 2), как невозможно определить точное количество волосков, которые нужно приобрести, чтобы перестать быть лысым, так и неправомерно говорить, что объект а<sub>5</sub> (объем=3.7) получает второе место, а объект а<sub>14</sub> – уже третье (объем=3,5). Эти два объекта отличаются по признаку п<sub>1</sub> менее, чем на 1,2, но из-за жесткого разделения шкалы на интервалы они попали в разные группы. </p>
<p>Предлагается следующая <b><i>модификация алгоритма векторной сортировки</i></b></p>
<ol>
<li>Для каждого объекта составляется <b><i>вектор значений признаков</i></b> (например, STL::vector), упорядоченных по приоритету. Значение наиболее приоритетного признака записывается в первую ячейку вектора, значение наименее приоритетного – в последнюю. Значения минимизирующихся признаков заменяются дополнениями до максимального значения шкалы или инвертируются с тем, чтобы использовать единое для вектора направление оптимизации – максимизацию</li>
<li>Составляется и сортируется вектор объектов, характеризующихся векторами значений. Например, можно использовать алгоритм STL::sort с предикатом сравнения векторов. Именно <b><i>предикат сравнения</i></b> векторов вещественных чисел возьмет на себя большую часть алгоритма векторной сортировки (в том числе с уступкой).</li>
<li>Предикат сравнения двух векторов (объектов) сравнивает последовательно значения очередного по приоритету признака (значения в очередной ячейке векторов). Если значения признака с приоритетом p равны <b><i>с заданной точностью</i></b>, сравниваются значения признака с приоритетом p+1. Если на некотором шаге обнаружено преимущество второго вектора над первым, предикат истинен, в противном случае или если все значения вплоть до наименее приоритетного признака равны – ложен.</li>
<li>После сортировки вектора объектов производится <b><i>расстановка рангов</i></b> в соответствии с позицией объекта в отсортированном векторе.</li>
<li><b><i>Уступка</i></b> реализуется в предикате сравнения. Если осуществляется уступка в пользу признака с приоритетом p+1, то при сравнении значений p-ого признака объекты считаются равными, если не отличаются друг от друга более чем на величину уступки. Иными словами, в предикате сравнения на шаге p заданная точность заменяется значением уступки.</li>
</ol>
<h2 align="center">Анализ модифицированного алгоритма</h2>
<p><b><i>Модифицированный алгоритм</i></b> обладает следующими <b><i>преимуществами</i></b>:</p>

<li>Простота реализации и модифицируемость</li>
<li>Увеличение скорости работы за счет минимизации числа сравнений и отказа от присвоения промежуточных мест</li>
<li>Отсутствие рекурсии</li>
<li>Обход парадокса «лысый»</li>
<br><br><b><i>Недостаток:</i></b>
<li>При использовании уступки за счет искусственного ослабления шкалы уступающего признака результаты сортировки будут <b><i>зависеть от распределения значений</i></b> уступающего признака (пояснения будут даны ниже). </li>

<p>Суть отличия модифицированного алгоритма векторной сортировки от классического в том, что классический вариант перебирает признаки, сравнивая объекты на кажом шаге, а модифицированный – перебирает объекты, сравнивая вектора признаков каждой пары. Что касается <b><i>многомерной сортировки без уступки</i></b>, результаты будут <b><i>совпадать</i></b> с результатами классического алгоритма при любых распределениях значений признаков. В самом деле, предикат сравнения двух объектов всегда сначала обращается к значениям наиболее приоритетного признака. Если объект лучше другого по наиболее приоритетному признаку, то он получит более высокий ранг при использовании обоих алгоритмов.
Если объекты равны по наиболее приоритетному признаку, то и в том, и в другом алгоритме, произойдет переход к следующему по приоритету признаку. Но результаты применения <b><i>уступки</i></b> для классического и модифицированного алгоритма, разумеется, будут <b><i>различаться</i></b> за счет обхода парадокса «Лысый» путем попарного сравнения векторов признаков двух объектов вместо разбиения шкалы признака на интервалы,. Более того, результаты работы модифицированного алгоритма сортировки с уступкой будут <b><i>зависеть от распределения значений</i></b> уступающего признака. Ниже приводится иллюстрация крайнего, наиболее неблагоприятного случая применения модифицированного алгоритма многомерной сортировки с уступкой:</p>
<br><div align="center"><i>Таблица 3. Уступка при сильно упорядоченных исходных данных.</i></div>
<div align="center"><img src="'. $site['setting']['base'] .'/img/m/0906/03/3.png" border="0"></div>
<p>Пусть значения обоих признаков минимизируются. Приоритет Признака №1 – 1, Признака №2 – 2. Используется уступка в пользу Признака №2. Её значение – 20%, этого достаточно для того, чтобы не различать два соседних значения Признака №1. Значения наиболее приоритетного признака (№1) в примере распределены так, что каждые два соседних объекта считаются равными. Сравнение 1го и 2го объектов, например, выявит их равенство по Признаку№1 и преимущество 1го по Признаку№2. В результате сравнения 2го и 3го объекта 3ий окажется хуже. Таким образом, после первого же прохода будет сделан вывод о том, что объекты изначально упорядочены, строго проранжированы, и алгоритм завершится.<br>Результаты сортировки неудовлетворительны, объекты оказались упорядочены по наименее приоритетному признаку, несмотря на то, что значение уступки &lt; 100%. 1ый объект получил первое место, хотя логично было бы расположить его на предпоследнем. Для сравнения можно рассмотреть результат работы того же алгоритма на тех же данных, но распределенных иначе:</p>
<br><div align="center"><i>Таблица 4. Уступка при слабо упорядоченных исходных данных</i></div>
<div align="center"><img src="'. $site['setting']['base'] .'/img/m/0906/03/4.png" border="0"></div>
<p>Результаты сортировки в слабоупорядоченной таблице более удовлетворительны. 1й объект получил предпоследнее место, 10й, лучший по Признаку №1, сместился на 3-е место за счет худшего значения по Признаку №2.</p>
<br><h2 align="center">Заключение.</h2>
<ol>
	<li>Применение модифицированного алгоритма вместо классического варианта <b><i>оправдано</i></b> в связи с указанными преимуществами</li>
	<li>Результаты многомерной сортировки без уступки в классическом и модифицированном варианте <b><i>идентичны</i></b>.</li>
	<li>Недостаток (зависимость результатов сортировки с уступкой от распределения данных) <b><i>незначителен</i></b> (в реальных задачах полностью упорядоченные по признаку данные встречаются редко) и <b><i>неустраним</i></b> при любой реализации (для любого алгоритма сортировки найдется такое распределение значений, при котором уступающий признак будет фактически исключен из рассмотрения)</li>
</ol>
<h2 align="center">Приложение. Пример программной реализации</h2><div align="center">(С++, STL)</div>
<p>Приводится один из возможных вариантов программной реализации модифицированного алгоритма векторной сортировки (в том числе с уступкой). Детали и окружение опущены.</p>

<pre class="code">
// Характеристика объекта – вектор значений признаков
typedef std::vector&lt;double&gt; VectorForPriority;

...

// Предикат сравнения векторов вещественных чисел. Истинен, если f хуже(меньше) s
class Less: std::binary_function&lt;const VectorForPriority&, const VectorForPriority&, bool&gt;
{
   private:
     int un;      // приоритет признака, в пользу которого делается уступка
     double uv;   // значение уступки
   public:
     Less (){};
     Less (int Un,double Uv):un(Un),uv(Uv){};
     // Суть алгоритма векторной сортировки
     bool operator()(const VectorForPriority& f, const VectorForPriority& s)
     {
      int sz=(int)f.size()-1;   // определение количества значимых признаков
      double delta;             // заданная точность сравнения
      for (int i=0; i&lt;sz; i++)
      {
        delta=(un==i)?uv:MIN;   // вычисление точности сравнения. Это либо
   	  // минимальное системное вещественное число, либо значение уступки
        // значения сравниваются либо до окончания векторов, либо до выявления
        // преимущества одного вектора над другим
        if (fabs(s[i]-f[i])&gt;delta) return f[i]&lt;s[i];
      }
      return false; // равенство векторов тоже делает предикат ложным
     }
};

...

// Метод сортировки. Concess – значение уступки (дается извне)
void VectorSort(double Concess)
{
   // 1. Формирование вектора характеристик, подготовленных для сортировки.
   // в каждом элементе вектора хранятся значения признаков объекта
   // упорядоченные по приоритету признаков (значимости)
   std::vector&lt;VectorForPriority&gt; v_Objects;

   // Вектор номеров (можно также имен, указателей и т.д.) признаков,
   // упорядоченных в соответствии с приоритетами
   std::vector&lt;int&gt; Atrs;
   // Метод определения номера (имени, указателя) зависит от структуры
   // окружения и к алгоритму не относится
   for (int j=0; j&lt;atr; j++) Atrs.push_back(GetAtrOfPriority(j));

   for (int i=0; i&lt;obj; i++) // оbj – число объектов задачи
   {
      VectorForPriority v_Object;
      for (int j=0; j&lt;atr; j++) // atr – число значимых признаков
      {
         // Получение значения признака объекта
         double vl=GetValue(i,Atrs[j]);
         // Получение направления оптимизации
         long dir=GetDirection(j);
         // Значения записываются с учетом направления оптимизации
         // таким образом, чтобы при упорядочении использовать только максимизацию
         v_Object.push_back((dir==MAXIMIZATION?-1:1)*vl);
      }
      // реальный номер объекта (имя, указатель) хранится в векторе характеристик
      // в последней ячейке, чтобы после сортировки было возможным определить,
      // какой именно объект занял некоторое место
v_Object.push_back(i);
      v_Objects.push_back(v_Object);
   }

   // 2. Сортировка с помощью СТЛ-алгоритма и предиката сравнения,
   // реализующего метод приоритетов. m_ConcessAttr – приоритет признака, в пользу
   // которого уступка. Уступка 0 и меньше считается отсутствием уступки.
   std::sort(v_Objects.begin(),v_Objects.end(),Less(Concess&raquo;0 ? m_ConcessAttr-1: -1,Concess);

   // 3. Расстановка рангов в соответствии с сортировкой, причем для
   // одинаковых векторов выставляются одинаковые ранги.
   // "одинаковость" определяется тем же предикатом сравнения для векторов.
   int place=1;
   for (int i=0; i&lt;obj-1; i++)
   {
      // Реальный номер (имя, указатель) объекта хранится в последней
      // ячейке вектора-характеристики
      SetRang(v_Objects[i][atr], place);  // назначение ранга
      // Увеличение текущего ранга, если соседние объекты различны
      // с точки зрения алгоритма
if (Less(Concess&gt;0?m_ConcessAttr-1:-1,Concess)
(v_Objects[i],v_Objects[i+1])) place++;
   }
   // последний объект не с чем сравнивать
   SetRang(v_Objects[obj-1][atr],place);
}

...
</pre>

<p style="text-align: right;"><i>С уважением, <a href="http://forum.sources.ru/index.php?showuser=4949" target="_blank">vk</a>!</i></p>

';
	break;
//-------------------------------------------------------------------------------------------------------

case '0906/04.html':
	$site['page']['title'] .= ' - Новостная лента на ASP.NET';
	$site['page']['description'] .= ' Новостная лента на ASP.NET';
	$site['page']['keywords'] .= ', Новостная лента, лента ASP';
	$site['page']['body'] = '<h1>Новостная лента на ASP.NET</h1>
<b>Автор:</b> <a href="http://forum.sources.ru/index.php?showuser=6018"><i>kosten_spb</i></a><br><br>

<p>В настоящее время очень распространена публикация новостей на различных web-сайтах. В этой статье будет рассказано о создании новостной ленты с поддержкой RSS средствами ASP.NET.</p>

<p>Для хранения новостей мы будем использовать MSSQL Server 2000. Новости будут храниться в таблице, структура которой приведена ниже:</p>
<br>
<div align="center"><img border="0" width="321" height="84" src="'. $site['setting']['base'] .'/img/m/0906/04/struct.gif" align="center"></div>

<p>Где поле id_news – уникальный идентификатор новости, news_date – дата создание новости, news_text – основной текст новости, news_link – ссылка на подробное описание новости.</p>

<p>Для создания этой таблицы можно использовать следующий SQL-запрос:</p>

<pre class="code">
CREATE TABLE [dbo].[News] 
(
	[id_news] [int] IDENTITY (1, 1) NOT NULL ,
	[news_date] [datetime] NOT NULL ,
	[news_text] [text] NOT NULL ,
	[news_link] [char] (250) NOT NULL 
)
ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO

ALTER TABLE [dbo].[News] WITH NOCHECK ADD 
	CONSTRAINT [PK_News] PRIMARY KEY  CLUSTERED 
	(
		[id_news]
	)  ON [PRIMARY] 
GO
</pre>

<p>Для получения блока новостей будем использовать следующую хранимую процедуру:</p>

<pre class=code>
CREATE PROCEDURE GetNews
AS BEGIN
SELECT TOP 3 news_text, news_date, news_link FROM News ORDER BY news_date DESC
END
</pre>

<p>Структура таблицы может быть дополнена или изменена по усмотрению разработчика.</p>

<p>Прежде чем приступить непосредственно к программированию, кратко познакомимся с технологией RSS.</p>

<p><b>RSS</b> (Really Simple Syndication) — дословно можно перевести как «очень простое синдицирование». <i>Syndicate (англ.)</i> – печатное агентство приобретающие информацию или непосредственно процесс приобретения информации. Другими словами, RSS – это формат обмена информацией в web. Изначально данный формат был разработан компанией Netscape для крупных новостных порталов. В последствии Netscape отказалась от поддержки своей версии формата RSS и передала его другой компании. В это время другая организация развивала свою версию RSS. В результате, в настоящее время известно семь форматов RSS разных версий. Возникает вопрос, какой формат RSS использовать в своих разработках? В данный момент, наиболее популярны версии 1.0 и 2.0, как стабильные. Остальные форматы отменены. Сравним форматы RSS 1.0 и 2.0.</p>

<br><br>
<table border="0" cellspacing="0" cellpadding="5" align="center">
<tr><th>Версия</th><th>Преимущества</th><th>Состояние</th><th>Рекомендации</th></tr>
<tr align="middle">
<td class=c2>1.0</td>
<td class=c2>Основан на языке RDF. Расширяется с помощью модулей. Не зависит от какой-либо одной компании</td>
<td class=c2>Стабилен. Ведется активная разработка модулей</td>
<td class=c2>Используйте для приложений, где используется RDF, либо в том случае, если вам нужен какой-то определенный модуль</td>
</tr>
<tr align=middle>
<td class=c1>2.0</td>
<td class=c1>Расширяется с помощью модулей. Прост при миграции с ветки форматов 0.9х</td>
<td class=c1>Стабилен. Ведется активная разработка модулей</td>
<td class=c1>Используйте для публикации новостей общего назначения</td></tr>
</table>

<p>В нашем примере мы будем работать с RSS 2.0. Рассмотрим структуру простого RSS документа (будем использовать только обязательные элементы):</p>

<pre class=code>
<font color=blue>&lt;?</font><font color=maroon>xml</font> <font color=red>version</font><font color=blue>="1.0"</font> <font color=red>encoding</font><font color=blue>="windows-1251" ?&gt;</font>
<font color=blue>&lt;</font><font color=maroon>rss</font> version="2.0"<font color=blue>&gt;</font>
	<font color=blue>&lt;</font><font color=maroon>channel</font><font color=blue>&gt;</font>
		<font color=blue>&lt;</font><font color=maroon>title</font><font color=blue>&gt;</font>Простой RSS канал<font color=blue>&lt;</font>/<font color=maroon>title</font><font color=blue>&gt;</font>
		<font color=blue>&lt;</font><font color=maroon>link</font><font color=blue>&gt;</font>http://www.mypage.ru<font color=blue>&lt;</font>/<font color=maroon>link</font><font color=blue>&gt;</font>
		<font color=blue>&lt;</font><font color=maroon>description</font><font color=blue>&gt;</font>Новости с моего сайта<font color=blue>&lt;</font><font color=maroon>description</font><font color=blue>&gt;</font>
		<font color=blue>&lt;</font><font color=maroon>item</font><font color=blue>&gt;</font>
			<font color=blue>&lt;</font><font color=maroon>title</font><font color=blue>&gt;</font>Первая новость<font color=blue>&lt;/</font><font color=maroon>title</font><font color=blue>&gt;</font>
			<font color=blue>&lt;</font><font color=maroon>link</font><font color=blue>&gt;</font>http://www.mypage.ru/news/1<font color=blue>&lt;/</font><font color=maroon>link</font><font color=blue>&gt;</font>
			<font color=blue>&lt;</font><font color=maroon>description</font><font color=blue>&gt;</font>Сайт начал работу.<font color=blue>&lt;/</font><font color=maroon>description</font><font color=blue>&gt;</font>
		<font color=blue>&lt;/</font><font color=maroon>item</font><font color=blue>&gt;</font>
		<font color=blue>&lt;</font><font color=maroon>item</font><font color=blue>&gt;</font>
			<font color=blue>&lt;</font><font color=maroon>title</font><font color=blue>&gt;</font>Открыт форум<font color=blue>&lt;/</font><font color=maroon>title</font><font color=blue>&gt;</font>
			<font color=blue>&lt;</font><font color=maroon>link</font><font color=blue>&gt;</font>http://www.mypage.ru/news/2<font color=blue>&lt;/</font><font color=maroon>link</font><font color=blue>&gt;</font>
			<font color=blue>&lt;</font><font color=maroon>description</font><font color=blue>&gt;</font>На сайте открыт форум.<font color=blue>&lt;/</font><font color=maroon>description</font><font color=blue>&gt;</font>
		<font color=blue>&lt;/</font><font color=maroon>item</font><font color=blue>&gt;</font>
	<font color=blue>&lt;/</font><font color=maroon>channel</font><font color=blue>&gt;</font>
<font color=blue>&lt;/</font><font color=maroon>rss</font></font><font color=blue>&gt;</font>
</pre>

<p>Корневым элементом в документе является rss с указанием номера версии в атрибуте version. В элемент rss вложен элемент channel, который имеет следующие обязательные элементы  - title (название канала), link (URL web-сайта соответствующего каналу) и description (описание канала). Элемент channel может содержать любое количество элементов item. Эти элементы могут содержать в себе публикации целиком, или же анонсы со ссылками на полные варианты публикаций. Все вложенные элементы являются необязательными, однако хотя бы один элемент &lt;title&gt; или &lt;description&gt; должен присутствовать. В нашем примере мы используем следующие элементы – title (заголовок новости), link (ссылка на полный вариант публикации), description (анонс новости).</p>

<p>Для разработки проекта будем использовать MS Visual Studio 2003. Создадим новый ASP.NET проект с именем rssnews:</p>

<br>
<div align="center"><img border="0" width="530" height="386" src="'. $site['setting']['base'] .'/img/m/0906/04/proj.jpg" align="center"></div>

<p>Добавим в проект два элемента – еще одну aspx-страницу и web user control. Назовем их rss.aspx (генератор RSS документа) и news.ascx (пользовательский элемент управления для отображения новостей). Созданную по умолчанию страницу WebForm1.aspx переименуем в Default.aspx.</p>

<p>Откроем элемент news.ascx в режиме  Design и разместим на нем компонент Repeater:</p>

<br>
<div align="center"><img border="0" width="304" height="109" src="'. $site['setting']['base'] .'/img/m/0906/04/rep.jpg" align="center"></div>

<p>В режиме HTML отредактируем файл news.ascx следующим образом:</p>

<pre class="code">
&lt;asp:Repeater id="Repeater1" runat="server"&gt;
	&lt;HeaderTemplate&gt;
		&lt;h4&gt;Новости&lt;/h4&gt;
		&lt;table&gt;
	&lt;/HeaderTemplate&gt;
	&lt;ItemTemplate&gt;
		&lt;tr&gt;
			&lt;td colspan="2"&gt;&lt;br&gt;
				&lt;%# DataBinder.Eval(Container.DataItem, "text") %&gt;
			&lt;/td&gt;
		&lt;/tr&gt;
		&lt;tr&gt;
			&lt;td&gt;&lt;%# DataBinder.Eval(Container.DataItem, "date") %&gt;&lt;/td&gt;
			&lt;td&gt;&lt;%# DataBinder.Eval(Container.DataItem, "link") %&gt;&lt;/td&gt;
		&lt;/tr&gt;
	&lt;/ItemTemplate&gt;
	&lt;FooterTemplate&gt;
		&lt;/table&gt;
	&lt;/FooterTemplate&gt;
&lt;/asp:Repeater&gt;
</pre>

<p>Тэги HeaderTemplate, ItemTemplate и FooterTemplate предназначены для описания заголовка, элемента и «башмака» таблицы.</p>

<p>Перейдем в режим редактирования кода и отредактируем файл news.ascx.cs следующим образом:</p>

<pre class="code">
namespace rssnews
{
	/// &lt;summary&gt;
	/// Summary description for news.
	/// &lt;/summary&gt;
	public class news : UserControl
	{
		protected Repeater Repeater1;

		private void Page_Load(object sender, EventArgs e)
		{
			// Put user code to initialize the page here
			ArrayList alNews = new ArrayList();
			SqlConnection sqlConn = new SqlConnection(ConfigurationSettings.AppSettings["connectionString"]);
			SqlCommand sqlComd = sqlConn.CreateCommand();
			sqlComd.CommandText = "GetNews";
			sqlComd.CommandType = CommandType.StoredProcedure;
			sqlConn.Open();
			sqlComd.ExecuteNonQuery();
			
			SqlDataAdapter sqlAdap = new SqlDataAdapter();
			sqlAdap.SelectCommand = sqlComd;
			
			DataSet ds = new DataSet();
			sqlAdap.Fill(ds, "news");
			DataTable dt = ds.Tables["news"];
			foreach(DataRow dr in dt.Rows)
			{
				News n = new News();
				n.date = dr["news_date"].ToString().Substring(0, 10);
				n.text = dr["news_text"].ToString();
				n.link = "&lt;a href=" + dr["news_link"].ToString() + ">Подробнее...&lt;/a&gt;";
				alNews.Add(n);
			}
			Repeater1.DataSource = alNews;
			Repeater1.DataBind();
		}
		#region Web Form Designer generated code
		override protected void OnInit(EventArgs e)
		{
			//
			// CODEGEN: This call is required by the ASP.NET Web Form Designer.
			//
			InitializeComponent();
			base.OnInit(e);
		}
		
		/// &lt;summary&gt;
		///		Required method for Designer support - do not modify
		///		the contents of this method with the code editor.
		/// &lt;/summary&gt;
		private void InitializeComponent()
		{
			this.Load += new EventHandler(this.Page_Load);

		}
		#endregion
	}
	public class News
	{
		private string Text;
		private string Link;
		private string Date;
		public string text
		{
			get
			{
				return Text;
			}
			set
			{
				Text = value;
			}
		}
		public string date
		{
			get
			{
				return Date;
			}
			set
			{
				Date = value;
			}
		}
		public string link
		{
			get
			{
				return Link;
			}
			set
			{
				Link = value;
			}
		}

	}
}
</pre>

<p>Механизм работы, приведенный в коде, следующий:
<ul>
<li>создается соединение с БД и вызывается хранимая процедура GetNews</li>
<li>заполняется список объектов класса News</li>
<li>происходит связывание компонента Repeater со списком объектов класса News</li>
</ul>
</p>

<p>Для реализации такого механизма в классе News используются общедоступные свойства text, date, link.</p>

<p>Страница с новостями готова, перейдем к реализации RSS в нашем проекте.<br>
Откроем страницу rss.aspx в режиме HTML и удалим все строки кроме первой, содержащей директиву Page:</p>

<pre class="code">
&lt;%@ Page language="c#" Codebehind="rss.aspx.cs" AutoEventWireup="false" Inherits="rssnews.rss" %&gt;
</pre>

<p>Перейдем в режим редактирования кода и отредактируем файл rss.aspx.cs следующим образом:</p>

<pre class="code">
using System;
using System.Configuration;
using System.Data;
using System.Data.SqlClient;
using System.Web.UI;

namespace rssnews
{
	/// <summary>
	/// Summary description for rss.
	/// </summary>
	public class rss : Page
	{
		private void Page_Load(object sender, EventArgs e)
		{
			// Put user code to initialize the page here
			SqlConnection scConn = new SqlConnection(ConfigurationSettings.AppSettings["connectionString"]);
			SqlCommand scComd = scConn.CreateCommand();
			scComd.CommandText = "select news_theme title, news_text description, news_link link from news item ORDER BY news_date DESC FOR XML  AUTO,ELEMENTS";
			scComd.CommandType = CommandType.Text;
			scConn.Open();
			scComd.ExecuteNonQuery();

			SqlDataAdapter sda = new SqlDataAdapter();
			sda.SelectCommand = scComd;
			DataSet ds = new DataSet();
			sda.Fill(ds, "xml");
			DataTable dt = ds.Tables["xml"];
			string strRss = "<?xml version="1.0" encoding="windows-1251"?><rss version="2.0"><channel>";
			strRss += "<title>Новости сайта</title><link>http://site.ru/News.aspx</link><description>Наши последние новости</description><language>en-us</language>";
			strRss += dt.Rows[0][0].ToString();
			strRss += "</channel></rss>";
			Response.ContentType = "text/xml";
			Response.Write(strRss);		
		}
		#region Web Form Designer generated code
		override protected void OnInit(EventArgs e)
		{
			//
			// CODEGEN: This call is required by the ASP.NET Web Form Designer.
			//
			InitializeComponent();
			base.OnInit(e);
		}
		
		/// <summary>
		/// Required method for Designer support - do not modify
		/// the contents of this method with the code editor.
		/// </summary>
		private void InitializeComponent()
		{    
			this.Load += new EventHandler(this.Page_Load);
		}
		#endregion
	}
}
</pre>

<p>Разберем приведенный выше листинг. В первую очередь производится соединение с БД и выполнятся SQL – запрос. На запросе остановимся подробнее. Используемый в программе SQL-запрос имеет следующий вид:</p>

<pre class="code">
SELECT news_theme title, news_text description, news_link link FROM news item 
ORDER BY news_date DESC FOR XML  AUTO, ELEMENTS
</pre>

<p>В данном запросе из таблицы News выбираются поля news_theme, news_text, news_link, которым даются псевдонимы title, description link соответственно. Самой таблице News дается псевдоним item. Выборка сортируется по полю news_date. Окончательный результат представляется в XML формате:</p>

<pre class="code">
&lt;item&gt;
&lt;title&gt;…&lt;/title&gt;
&lt;link&gt;…&lt;/link&gt;
&lt;description&gt;…&lt;/description&gt;
&lt;/item&gt;
&lt;item&gt;
…
&lt;/item&gt;
</pre>

<img border="0" width="168" height="323" src="'. $site['setting']['base'] .'/img/m/0906/04/scr.jpg" align="left">

<p>Таким образом, мы получили часть RSS документа. Далее полученный XML ответ из БД дополняется до необходимого формата, соответствующего спецификации RSS.</p>

<p>Для тестирования новостной ленты необходимо обратится к сайту, указав соответствующий адрес в адресной строке браузера (на моей машине он выглядит так  - http://localhost/aspdev/rssnews/Default.aspx). Примерный результат представлен на рисунке. Что изменить вид новостной ленты, необходимо изменить содержимое тэгов HeaderTemplate, ItemTemplate и FooterTemplate компонента Repeater.</p>

<p>Тестирование RSS производится при помощи любого RSS reader’а. В качестве адреса потока (feed) необходимо указать адрес страницы генерирующей RSS документ (в моем случае он выглядит так http://localhost/aspdev/rssnews/rss.aspx).</p>

<p>Замечание: во всех приведенных примерах для получения строки соединения (connection string) с БД используется параметр connectionString записанный в файл web.config следующим образом:</p>

<pre style="color: #008; background-color: #f6f6ff; border: solid 1px #cbcbff; padding: 5px; font-family: "courier new", "courier"; overflow: auto">
&lt;add key="connectionString" value="workstation 
id=computerName;packet size=4096;user id=user;pwd=secret;
data source=computerName;persist security info=False;initial catalog=DBName" /&gt;
</pre>

<br clear="left">
<hr>
<b>Скачать исходник:</b> <a href="'. $site['setting']['base'] .'/img/m/0906/04/rssnews.zip">rssnews.zip</a>&nbsp;(13 кб)
';
	break;
//-------------------------------------------------------------------------------------------------------

case '0906/07.html':
	$site['page']['title'] .= ' - Красивые ... окна | ListBox | PopupMenu';
	$site['page']['body'] = '<h1>Часть третья. Красивый PopupMenu.</h1>

<b>Автор:</b> <a href="http://forum.sources.ru/index.php?showuser=21926"><i>Der Peti@</i></a><br>
<br><a href="'. $site['setting']['base'] .'/0906/05.html#first">Часть первая. Красивые окна.</a>
<br><a href="'. $site['setting']['base'] .'/0906/06.html">Часть вторая. Красивый ListBox.</a>
<br>Часть третья. Красивый PopupMenu.
<br><br><a href="http://forum.sources.ru/index.php?showtopic=161953">Рецензия на статью.</a>
<img src="'. $site['setting']['base'] .'/img/m/0906/07/Menu.gif" align="left"><p>Для начала откомпилируйте <a href="'. $site['setting']['base'] .'/img/m/0906/07/lesson3.rar">исходник этого урока</a> и посмотрите, что получится в итоге. Так вам будет легче понять, что я тут дальше написал. Кликните правой кнопкой. Правда, красиво? Итак, начнём с общих концепций. В Интернете хватает статей, как приукрасить всплывающие менюшки, рисуя их через OwnerDraw-функции (как мы ListBox во <a href="'. $site['setting']['base'] .'/0906/06.html">второй части</a>). Например, <a href="http://www.delphikingdom.com/asp/viewitem.asp?catalogid=511">эта</a>. Но таким способом что-то очень красивое всё равно не нарисуешь. Как сделать, чтоб "выделение" плавно "ездило" за курсором (это я расскажу в этой части)? Как сделать, например, всплывающее меню с ComboBox-ом (это уже сделаете сами, когда прочитаете статью ?)? Мне продолжать? Ладно, ближе к делу.<br>
Как уже некоторые правильно догадались, наше всплывающее меню – вовсе не меню, а самая обыкновенная форма. Вот поэтому-то навороченность нашей менюшки теоретически не ограничена. Поехали. Добавляем к нашему проекту новую форму и обзываем её PopupForm. Кидаем на форму TImage, называем его BackgroundImage, и загружаем в него <a href="'. $site['setting']['base'] .'/img/m/0906/07/Popup.jpg">фоновую картинку</a>. В OnFormCreate пишем:</p>

<pre class="code">procedure TPopupForm.FormCreate(Sender: TObject);
begin
  // Изначально меню "спрятано"
  State := False;

  // Убираем границы окна
  BorderStyle := bsNone;

  // Прозрачность
  AlphaBlend := True;

  // Если это будет всплывающее меню для какой-нибудь
  // программы, сидящей в трее, то, чтоб при появлении
  // меню не перекрывалось таскбаром оставьте эту строчку
  FormStyle := fsStayOnTop;

  // Подгоняем размеры формы под размеры фонового рисунка
  Width := BackgroundImage.Width;
  Height := BackgroundImage.Height;
end; </pre>
<p>Переменная State (должна быть описана как глобальная) будет отвечать за состояние меню: появление или пропадание. По-аналогии с PopupMenu напишем процедуру вызова меню.</p>
<pre class="code">type
  TPopupForm = class(TForm)
    ...
  public
    { Public declarations }
    procedure Popup(X,Y: Integer);
  end;</pre>
<p>И код процедуры</p>
<pre class="code">procedure TPopupForm.Popup(X,Y: Integer);
begin
</pre>
<p>Первым делом надо сделать меню видимым. Если это просто всплывающее меню, то можно написать «Show;», но если это меню будет всплывать по клику по значку в трее, то чтоб в таскбаре не появлялась наша программа, напишите вариант с ShowWindow.</p>
<pre class="code">// Делаем окно видимым
  // Если меню для трея то используйте ShowWindow
  // ShowWindow(Handle,SW_SHOWNORMAL);
  Show;
</pre>
<p>Далее нашей форме нужно задать координаты X,Y. Обычно все менюшки появляются справа и снизу от курсора. Но есть одно «но». Кликните правой кнопкой на рабочем столе (курсор при этом должен находиться почти впритык к правому краю экрана). Видите? Когда для меню справа недостаточно места для его полного отображения, оно "вываливается" влево. То же самое будет, если покликать внизу экрана. Как узнать хватает ли справа места? Воспользуемся функцией GetSystemMetrics, которая может вернуть нам ширину/высоту экрана. А дальше – математика. От ширины отнимаем координату X, и, если разность больше ширины меню, то места справа хватает.</p>
<pre class="code">  if ( GetSystemMetrics(SM_CXSCREEN) - X ) &lt; Width then
    Left := X - Width // меню вываливается влево
  else
    Left := X; // меню вываливается влево

  if ( GetSystemMetrics(SM_CYSCREEN) - Y ) &lt; Height then
    Top := Y - Height // меню вываливается вверх
  else
    Top := Y; // меню вываливается вниз</pre>
<p>Далее окно нужно перевести в режим появления и поставить начальную прозрачность 0, то есть сделать окно полностью прозрачным. </p>
<pre class="code">  // Переводим окно в режим появления
  State := True;
  // Стартовая прозрачность 0
  AlphaBlendValue := 0;
</pre>
<p>В Windows есть такое понятие – ForegroundWindow, то есть активное окно. В Windows XP заголовок активного окна тёмно-синий, а у всех остальных светло-синий. Наше меню-окно тоже надо сделать активным.</p>
<pre class="code">// Делаем окно активным
  SetForegroundWindow(Handle);
</pre>
<p>Как вы заметили, наше окно появляется "плавно" то есть его прозрачность плавно изменяется от 0 до 255. Это можно делать с помощью таймера или при помощи процедуры "повешенной" на сообщение WM_TIMER. Но поскольку эта статья для широких масс, то напишу вариант с таймером. Заключительной строчкой процедуры Popup будет запуск таймера.</p>
<pre class="code">// Запуск таймера
  Timer1.Enabled := True;
end;
</pre>
<p>А теперь сам таймер. Киньте на форму таймер, сделайте его изначально выключенным (Enabled -> False) и поставьте интервал 1. Напишем процедуру OnTimer.</p>
<pre class="code">procedure TPopupForm.Timer1Timer(Sender: TObject);
begin
  FormStyle := fsStayOnTop;
  if State then
  begin
    // Форма в режиме появления
    if AlphaBlendValue &lt; 255 then
    begin
      // Если форма ещё полупрозрачна, то уменьшаем прозрачность
      AlphaBlendValue := AlphaBlendValue + 15;
    end;
  end else
  begin
    // Форма в режиме пропадания
    if AlphaBlendValue &gt; 10 then
    begin
      // Если форма ещё полупрозрачна, то уменьшаем прозрачность
      AlphaBlendValue := AlphaBlendValue - 25;
    end else
    begin
      // Когда форма уже почти совсем не видна закрываем её.
      Close;
    end;
  end;
end;</pre>
<p>Как видно из кода, меню будет появляться чуть-чуть медленнее, чем пропадать. Осталось только к нашей первой форме (та, которая с ListBox-ом) привязать эту менюшку. Делается всё совсем просто. При отпускании кнопки мыши на форме проверяем, что была нажата именно правая кнопка, узнаём текущие координаты курсора и вызываем метод Popup нашей формы-меню.</p>

<pre class=code>
procedure TForm1.FormMouseUp(Sender: TObject; Button: TMouseButton;
  Shift: TShiftState; X, Y: Integer);
var
  Point: TPoint;
begin
  // Проверяем, что была отпущена именно правая кнопка
  if Button = mbRight then
  begin
    GetCursorPos(Point); // Узнаём координаты курсора
    PopupForm.Popup(Point.X, Point.Y);
  end;
end;
</pre>
<p>У вас может возникнуть логичный вопрос: почему при вызове Popup нельзя передать координаты X и Y из самой процедуры OnMouseUp? Отвечаю: в процедуру OnMouseUp нам подставляются X и Y, где за точку (0,0) считается левый верхний край формы, а нам нужен левый верхний угол экрана. Запускайте.<br>
         Ну вот, уже что-то есть. Сразу заметен баг: если вызвать меню и потом сделать левый клик на родительской форме, то меню не пропадает. Исправляем. Нужно в самом конце процедуры Timer1Timer дописать следующий код:</p>
<pre class="code">  ...
  if State then // Окно находиться в режиме появления?
    if GetForegroundWindow &lt;&gt; Handle then // Окно перестало быть активным?
      State := False;
end; </pre>
<p>Итак, половину уже сделали. Далее сделаем выделение. Кидаем на форму TImage и обзываем его Selection. Это будет картинка выделения. Чтоб было красиво, засуньте в Selection <a href="./07/Select.ico">иконку</a>. Я для этих целей использовал программу <a href="http://www.awicons.com/awicons.html">AWIcons</a>. Накидайте ещё парочку TLabel-ов - это будут наши разделы меню. У меня их будет три: ExitLabel (Left: 32; Top: 175), Label1 (Left: 32; Top: 150) и Label2 (Left: 32; Top: 127). Шрифт в TLabel-ах я использовал Tahoma bold 9. Теперь можно было бы схалтурить: в OnMouseMove для TLabel-ов задавать подходящую высоту для Selection и всё, но мы же хотим, чтоб оно "ездило".
         Заведите глобальную переменную NeededTop - это будет, та высота, которая должна быть у Selection, но заметьте, что реальная высота и нужная могут не совпадать. По-умолчанию присвойте этой переменной значение 124. Теперь напишем обработчик движения мыши по BackgroundImage. Просто узнаём каждый раз положение курсора и, зная его положение, определим, напротив какого TLabel-а сейчас находится курсор, и зададим соответствующее значение переменной NeededTop. Всё числа найдены путём подбора.
</p>
<pre class="code">procedure TPopupForm.BackgroundImageMouseMove(Sender: TObject;
  Shift: TShiftState; X, Y: Integer);
var
  Point: TPoint;
begin
  GetCursorPos(Point); // Узнаём положение курсора
  Point.Y := Point.Y - Top; // Y относительно высоты формы
  NeededTop := 124; // Максимальная высота
  if Point.Y &gt; 171 then begin NeededTop := 171; Exit; end;
  if Point.Y &gt; 147 then begin NeededTop := 146; Exit; end;
  if Point.Y &gt; 124 then begin NeededTop := 124; Exit; end;
end;</pre>
<p>Научим выделение ездить. Поместите на форму ещё один таймер, задайте интервал 2 и в обработчике напишите:</p>


<pre class="code">procedure TPopupForm.Timer2Timer(Sender: TObject);
begin
  // Выделение ниже нужной высоты
  if Selection.Top &gt; NeededTop then
    Selection.Top := Selection.Top - 3;

  // Выделение выше нужной высоты
  if Selection.Top &lt; NeededTop then
    Selection.Top := Selection.Top + 3;

  // Расстояние до нужной высоты меньше шага
  if abs(Selection.Top - NeededTop) &lt; 3 then
    Selection.Top := Selection.Top;
end;</pre>
<p>Вот вам ещё обработчик кликов. Как узнать, по какому TLabel-у кликнули? По тому, который сейчас активен (можно определить, используя NeededTop). Эта процедура должна быть общей для всех TLabel-ов и Selection.</p>
<pre class="code">procedure TPopupForm.SelectionClick(Sender: TObject);
begin
  case NeededTop of
    124: begin // Label2
         end;
    146: begin // Label1
         end;
    171: begin // ExitLabel
           Application.Terminate;
         end;
  end;
end; </pre>
<p>Вот и всё. Надеюсь, парочка этих статей поможет сделать вам вашу программу красивее</p>

<br><hr>
<b>Скачать исходник:</b> <a href="'. $site['setting']['base'] .'/img/m/0906/07/lesson3.rar">lesson3.rar</a>&nbsp;(58 кб)
<p style="text-align: right;"><i>С уважением, <a href="http://forum.sources.ru/index.php?showuser=21926" target="_blank">Der Peti@</a>!</i></p>
';
	break;
//-------------------------------------------------------------------------------------------------------

case '0906/06.html':
	$site['page']['title'] .= ' - Красивые ... окна | ListBox | PopupMenu';
	$site['page']['body'] = '<h1>Часть вторая. Красивый ListBox.</h1>

<b>Автор:</b> <a href="http://forum.sources.ru/index.php?showuser=21926"><i>Der Peti@</i></a><br>
<br><a href="'. $site['setting']['base'] .'/0906/05.html">Часть первая. Красивые окна.</a>
<br>Часть вторая. Красивый ListBox.
<br><a href="'. $site['setting']['base'] .'/0906/07.html">Часть третья. Красивый PopupMenu.</a>
<br><br><a href="http://forum.sources.ru/index.php?showtopic=161953">Рецензия на статью.</a>

<img src="'. $site['setting']['base'] .'/img/m/0906/05/ListBox.gif" align=left><p>Наверное, статей про OwnerDraw ListBox-ов хватает. Но всё же я напишу свой вариант. За основу возьмём <a href="'. $site['setting']['base'] .'/img/m/0906/05/lesson1.rar">то (file)</a>, что получилось в конце <a href="'. $site['setting']['base'] .'/0906/05.html">первого урока</a>. Итак, кидаем на форму ListBox и задаём для него BorderStyle = bsNone, так как его рамку рисовать будем сами. Также параметру Style задайте значение lbOwnerDrawVariable. Ещё закиньте в ListBox какой-нибудь текст, чтоб его было видно (Items, если кто забыл). Запускаем.
Пока ничего такого нет. Кстати, вы заметили, что по умолчанию первая строчка как бы "наполовину" выделена (она не синяя, но вокруг есть рамка из точечек), это состояние odFocused. А если мы кликнем по строчке, и она станет синей, то это уже будет состояние odSelected. Итак, поехали. Нарисуем рамку ListBox-а.</p>
<pre class="code">procedure TForm1.FormPaint(Sender: TObject);
begin
  // Границы окна
  Canvas.FrameRect(Rect(0, 0 , Width, Height));
  // Границы ListBox-a
  Canvas.FrameRect(Rect(ListBox1.Left - 2, ListBox1.Top  - 2,
                        ListBox1.Left + ListBox1.Width + 2,
                        ListBox1.Top  + ListBox1.Height + 2));
end;</pre>
<p>Напишем обработчик OnDrawItem для нашего ListBox-a. Когда этому методу присвоена какая-то функция, то ListBox рисуется не "сам", а с помощью присвоенной функции.</p>
<pre class="code">procedure TForm1.ListBox1DrawItem(Control: TWinControl; Index: Integer,
  Rect: TRect; State: TOwnerDrawState);
begin</pre>
<p>В Index подставляется номер рисуемой строки, а в Rect прямоугольник (rectangle), ограничивающий эту строку. В State подставляется состояние строчки odSelected, odFocused или просто ничего, если строчка не выделена.</p>
<pre class="code">ListBox1.Canvas.Brush.Style := bsSolid;
  // Если строчка выделена то рисуем зелёную рамку
  if odSelected in State then
  begin
    ListBox1.Canvas.Brush.Color := $00B6FFB6;
    // Рисуем "залитый" прямоугольник
    ListBox1.Canvas.FillRect(Rect);
    ListBox1.Canvas.Brush.Color := $0051CE51;
    // Рисуем "пустой" прямоугольник
    ListBox1.Canvas.FrameRect(Rect);
  end else
  // или заливаем фон белым цветом если не выделена
  begin
    ListBox1.Canvas.Brush.Color := clWhite;
    // Рисуем "залитый" прямоугольник
    ListBox1.Canvas.FillRect(Rect);
  end;</pre>
<p>Запускаем. Ну конечно же! Текст-то тоже самим надо рисовать.</p>
<pre class="code">// Изменять координаты прямоугольника не обязательно
  // просто так красивее смотрится, можете закомментировать
  Rect.Top := Rect.Top + 1;
  Rect.Left := Rect.Left + 2;

  // Это надо, чтоб текст выводился без фона
  ListBox1.Canvas.Brush.Style := bsClear;

  // Задаём цвет текста
  ListBox1.Canvas.Font.Color := clBlack;

  // Рисуем текст
  DrawText(ListBox1.Canvas.Handle, PChar(ListBox1.Items[Index]),
           Length(ListBox1.Items[Index]), Rect, 0);
end;</pre>
<p>Вот собственно и всё. Как-то слишком коротко и просто получилось. Зато третий урок как целых два!</p>
<br><hr>
<b>Скачать исходник:</b> <a href="'. $site['setting']['base'] .'/img/m/0906/06/lesson2.rar">lesson2.rar</a>&nbsp;(42 кб)
<p style="text-align: right;"><i>С уважением, <a href="http://forum.sources.ru/index.php?showuser=21926" target="_blank">Der Peti@</a>!</i></p>';
	break;
//-------------------------------------------------------------------------------------------------------

case '0906/05.html':
	$site['page']['title'] .= ' - Красивые ... окна | ListBox | PopupMenu';
	$site['page']['body'] = '<h1>Часть первая. Красивые окна</h1>

<b>Автор:</b> <a href="http://forum.sources.ru/index.php?showuser=21926"><i>Der Peti@</i></a><br>
<br>Часть первая. Красивые окна.
<br><a href="'. $site['setting']['base'] .'/0906/06.html">Часть вторая. Красивый ListBox.</a>
<br><a href="'. $site['setting']['base'] .'/0906/07.html">Часть третья. Красивый PopupMenu.</a>
<br><br><a href="http://forum.sources.ru/index.php?showtopic=161953">Рецензия на статью.</a>
<h2>Предисловие</h2>
<p>В этой статье я попробую поделиться своими знаниями с читателями. Это мой первый опыт написания статей, так что надеюсь на благосклонность. О чём же мне написать? Конечно же, о том, в чём я более-менее разбираюсь. В моей программе <a href="http://www.geargames.t35.com/shortcut.php?lang=rus">GEAR ShortCut Master</a> довольно красивый интерфейс, и я расскажу вам, как я этого добился. Так сказать, частично открою исходные коды. Итак, начнём. Сразу скажу, что всё будет на Delphi и С-программистам толку от этой статьи мало. Постараюсь всё объяснять как можно подробнее, потому что, когда сам был чайником, меня сбивали с толку статьи, написанные для продвинутых программистов, в которых я ничего не мог понять.</p>
<a name="first" style="text-decoration: none"><h2 Align=Center>Часть первая. Красивые окна.</h2></a>
<p>Многих устраивает стандартный стиль Windows, но раз вы читаете эту статью, то вам он, наверное, как и мне, не нравится. Начнём с простого. В этой статье я покажу вам, как делать красивые окошки. Кто думает: читать или не читать, вот вам прямая ссылка на то, что получится после прочтения статьи. Если понравится, можете читать дальше.<br>
Итак, создайте пустой проект в Delphi. Так как кнопочки закрытия и сворачивания окна у нас будут свои, то BorderStyle задаём bsNone. Так же я в своём примере сделаю форму белой (Color = clWhite). Запускайте программу.<br>
Сразу бросаются в глаза три проблемы: окно появляется в верхнем левом углу экрана, плохо видны границы окна, если у вас светлый wallpaper на рабочем столе, и, самое главное, окно нельзя "таскать". Первые две проблемы решаются довольно легко, а последнюю оставим "на сладенькое". Чтоб окно создавалось, допустим, в центре экрана, задайте свойству Position значение poScreenCenter. Чтобы границы окна было хорошо видно, можно сделать TImage на всю форму и загрузить в него картинку, которая будет чем-то вроде фонового рисунка формы. Но если вам надо что-то простенькое и не хочется раздувать размеры exe-шника (а в Delphi они и так большие ?), то можно сделать вот что. В обработчике OnPaint будем по краям формы рисовать границы, пользуясь методом TCanvas FrameRect.
</p>
<pre class="code">procedure TForm1.FormPaint(Sender: TObject);
begin
  Canvas.FrameRect (Rect(0, 0 , Width, Height));
end</pre>
<p>Этот способ ещё хорош и тем, что при изменении размеров окна, границы всё равно будут рисоваться по его краям. Но если сейчас запустить программу, то границ мы не увидим, так как не задали цвет, которым будем их рисовать.</p>
<pre class="code">procedure TForm1.FormCreate(Sender: TObject);
begin
  Canvas.Brush.Color := clBlack; // у меня границы будут чёрными
end; </pre>
<p>Запускаем. Ну вот, уже лучше, осталось только научить форму "таскаться". Заведите в unit-те с формой глобальные переменные CursorPos, FormPos: TPoint; и Drag: boolean;. По умолчанию в Delphi булевские переменные принимают значение False. Это нам и надо. Переменная Drag будет отвечать, за то, в каком режиме находится форма: в режиме перетаскивания или в нормальном. Вверху формы разместите какой-нибудь TImage - это будет "активная" область, за которую и будет "таскаться" окно. Теперь давайте поймем, как работает обычный Windows-механизм "таскания" окон. Мы нажимаем мышку в пределах "активной" области, окно переходит в режим перетаскивания и будет таскаться за курсором, пока мы не отпустим мышку и тем самым не выведем окно из режима перетаскивания. Мы сделаем то же самое. Напишем обработчик нажатия мышки в пределах "активной" области.</p>
<pre class="code">procedure TForm1.Image1MouseDown(Sender: TObject; Button: TMouseButton;
  Shift: TShiftState; X, Y: Integer);
begin
  if Button = mbLeft then // чтоб не "таскалось" по нажатию правой кнопки мыши
  begin
    Drag := True;
    // Запоминаем положение окна в момент начала перетаскивания
    FormPos.X := Left;
    FormPos.Y := Top;
    // Запоминаем положение курсора в момент начала перетаскивания
    GetCursorPos(CursorPos);
  end;
end; </pre>
<p>И обработчик отпускания кнопки мышки</p>
<pre class="code">procedure TForm1.Image1MouseUp(Sender: TObject; Button: TMouseButton;
  Shift: TShiftState; X, Y: Integer);
begin
  if Button = mbLeft then Drag := False;
end; </pre>
<p>Теперь надо сделать самое главное: чтоб окно в режиме перетаскивания двигалось вместе с курсором. В Delphi у Application есть такой параметр – OnIdle, ему присваивается процедура, которая в зависимости от возвращаемого переменной Done значения вызывается, как только в системе наблюдается бездействие (Done = True).</p>
<pre class="code">procedure TForm1.OnIdle(Sender: TObject; var Done: boolean);
var Point: TPoint;
begin
  if Drag then // Проверяем находится ли форма в режиме перетаскивания
    GetCursorPos(Point); // Узнаём новые координаты курсора
    // Двигаем окошко
    Left := FormPos.X + Point.X - CursorPos.X;
    Top := FormPos.Y + Point.Y - CursorPos.Y;
  end;
end; </pre>
<p>Осталось только назначить параметру OnIdle нашу процедуру:</p>
<pre class="code">procedure TForm1.FormCreate(Sender: TObject);
begin
  Canvas.Brush.Color := clBlack; // у меня границы будут чёрными
  Application.OnIdle := OnIdle;
end; </pre>
<p>Ну и напоследок. Нужен "крестик", чтоб закрывать окошко. Киньте ещё один TImage на форму. Загрузите в него картинку какого-нибудь крестика и напишите следующее:</p>
<pre class="code">procedure TForm1.Image2MouseDown(Sender: TObject; Button: TMouseButton;
  Shift: TShiftState; X, Y: Integer);
begin
  Image2.Left := Image2.Left + 1;
  Image2.Top := Image2.Top + 1;
end;

procedure TForm1.Image2MouseUp(Sender: TObject; Button: TMouseButton;
  Shift: TShiftState; X, Y: Integer);
begin
  Image2.Left := Image2.Left - 1;
  Image2.Top := Image2.Top - 1;
end;

procedure TForm1.Image2Click(Sender: TObject);
begin
  Close;
end;</pre>
<p>Для сворачивания окна в обработчике клика напишите:</p>
<pre class="code">Application.Minimize;</pre>
<p>Кстати, вот вам полезный совет. Если у вас будет много кнопок-картинок, то заводить для каждой кнопки отдельную процедуру OnMouseDown и OnMouseUp не надо. Можно написать одну общую для всех.</p>
<pre class="code">procedure TForm1.ImageMouseDown(Sender: TObject; Button: TMouseButton;
  Shift: TShiftState; X, Y: Integer);
begin
  (Sender as TImage).Left := (Sender as TImage).Left + 1;
  (Sender as TImage).Top := (Sender as TImage).Top + 1;
end;</pre>
<p>Ну и по аналогии для отпускания мыши.</p>

<br><hr>
<b>Скачать исходник:</b> <a href="'. $site['setting']['base'] .'/img/m/0906/05/lesson1.rar">lesson1.rar</a>&nbsp;(40 кб)
<p style="text-align: right;"><i>С уважением, <a href="http://forum.sources.ru/index.php?showuser=21926" target="_blank">Der Peti@</a>!</i></p>
';
	break;
//-------------------------------------------------------------------------------------------------------

case '0906/08_enclosure.html':
	$site['page']['title'] .= ' - Справочник использованных функций';
	$site['page']['description'] .= ' Справочник использованных функций.';
	$site['page']['body'] = '<h1>Справочник использованных функций</h1>'.
"<script>
  function moreinfo(img_id, div_id)
  {
    var img = document.getElementById(img_id);
    var div = document.getElementById(div_id);
    div.style.display = (div.style.display == 'none') ? 'block' : 'none';
    var state = img.src.substr(img.src.lastIndexOf('/') + 1);
    img.src = (state == 'plus.gif') ? '/img/minus.gif' : '/img/plus.gif';
  }
</script>".'
<b>Автор:</b> <a href="http://forum.sources.ru/index.php?showuser=9930"><i>orb</i></a>

<p>В данном приложении перечислены использованные функции и их описание. Порядок следования функции установлен по мере использования в статье.</p>

<br>
<div class="first_line"><img src="'. $site['setting']['base'] .'/img/plus.gif" align="absmiddle" height="9" width="9" border="0" onclick="moreinfo(\'img1\', \'elem1\');" id="img1"><b>IDirect3D9 *Direct3DCreate9(UINT SDKVersion)</b></div>
<div id="elem1" style="display: none; margin-left: 20px">Возвращает указатель на интерфейс IDirect3D9. Функция использует только один макрос <code>D3D_SDK_VERSION</code>, который определен в заголовочном файле d3d9.h, указывающий на текущую версию SDK. Если функция возвратила NULL, то очевидно Direct3D не установлен на компьютере пользователя.
</div><br>

<div class="first_line"><img src="'. $site['setting']['base'] .'/img/plus.gif" align="absmiddle" height="9" width="9" border="0" onclick="moreinfo(\'img2\', \'elem2\');" id="img2"><b>HRESULT GetAdapterDisplayMode(UINT Adapter, D3DDISPLAYMODE *pMode)</b></div>
<div id="elem2" style="display: none; margin-left: 20px">Возвращает текущий режим отображения адаптера.<br>
<b>Adapter</b> – видеоадаптер дисплея, значение <code>D3DADAPTER_DEFAULT</code> использует всегда первичный адаптер по умолчанию.<br>
<b>pMode</b> - указатель на структуру <code>D3DDISPLAYMODE</code>, которая содержит описание текущего режима адаптера.
Возвращаемое значение. Если функция завершена успешно, тогда возвращается значение <code>D3D_OK</code>. Если Adapter или pMode неверен, тогда возвращается значение <code>D3DERR_INVALIDCALL</code>.
</div><br>

<div class="first_line"><img src="'. $site['setting']['base'] .'/img/plus.gif" align="absmiddle" height="9" width="9" border="0" onclick="moreinfo(\'img3\', \'elem3\');" id="img3"><b>D3DDISPLAYMODE</b></div>
<div id="elem3" style="display: none; margin-left: 20px">Описание текущего режима адаптера
<pre class="code">
typedef struct _D3DDISPLAYMODE
{
UINT Width;         //ширина рабочей поверхности экрана в пикселах
UINT Height;        //высота рабочей поверхности экрана в пикселах
UINT RefreshRate;   //частота регенерации, значение 0 – по умолчанию
D3DFORMAT Format;   //формат режима визуального отображения
} D3DDISPLAYMODE;
</pre>
</div><br>

<div class="first_line"><img src="'. $site['setting']['base'] .'/img/plus.gif" align="absmiddle" height="9" width="9" border="0" onclick="moreinfo(\'img4\', \'elem4\');" id="img4"><b>D3DFORMAT</b></div>
<div id="elem4" style="display: none; margin-left: 20px">
Перечисляемый тип, определяющий типы поверхностных форматов. Полное описание можно просмотреть в MSDN, здесь рассмотрены только наиболее используемые.<br><br>
<table border="0" cellspacing="0" cellpadding="5">
<tr><th>Флаг</th><th>Значение</th><th>Описание</th></tr>
<tr><td class=c1>D3DFMT_UNKNOWN</td><td class=c1>0</td><td class=c1>формат поверхности, используемый по умолчанию</td></tr>
<tr><td class=c2>D3DFMT_R8G8B8</td><td class=c2>20</td><td class=c2>24-битный формат RGB</td></tr>
<tr><td class=c1>D3DFMT_A8R8G8B8</td><td class=c1>21</td><td class=c1>32-битный формат АRGB</td></tr>
<tr><td class=c2>D3DFMT_D16_LOCKABLE</td><td class=c2>70</td><td class=c2>16-битный формат буфера глубины</td></tr>
<tr><td class=c1>D3DFMT_D32</td><td class=c1>71</td><td class=c1>32-битный формат буфера глубины</td></tr>
<tr><td class=c2>D3DFMT_D15S1</td><td class=c2>73</td><td class=c2>16-битный формат буфера глубины, где 15 бит – канал глубины, 1 бит – канал трафарета</td></tr>
<tr><td class=c1>D3DFMT_D24S8</td><td class=c1>75</td><td class=c1>32-битный формат буфера глубины, где 24 бита – канал глубины, 8 бит – канал трафарета</td></tr>
<tr><td class=c2>D3DFMT_D24X8</td><td class=c2>77</td><td class=c2>32-битный формат буфера глубины, где 24 бита – резервируются для канала глубины</td></tr>
<tr><td class=c1>D3DFMT_D24X4S4</td><td class=c1>79</td><td class=c1>32-битный формат буфера глубины, где 24 бита канал глубины, 4 бита – канал трафарета</td></tr>
<tr><td class=c2>D3DFMT_D16</td><td class=c2>80</td><td class=c2>16-битный формат буфера глубины</td></tr>
<tr><td class=c1>D3DFMT_VERTEXDATA</td><td class=c1>100</td><td class=c1>Формат поверхности буфера глубины</td></tr>
<tr><td class=c2>D3DFMT_INDEX16</td><td class=c2>101</td><td class=c2>16-битный индекс буфера глубины</td></tr>
<tr><td class=c1>D3DFMT_INDEX32</td><td class=c1>102</td><td class=c1>32-битный индекс буфера глубины</td></tr>
</table>
</div><br>

<div class="first_line"><img src="'. $site['setting']['base'] .'/img/plus.gif" align="absmiddle" height="9" width="9" border="0" onclick="moreinfo(\'img5\', \'elem5\');" id="img5"><b>typedef struct _D3DPRESENT_PARAMETERS_</b></div>
<div id="elem5" style="display: none; margin-left: 20px">
<pre class="code">
UINT BackBufferWidth;
UINT BackBufferHeight;
D3DFORMAT BackBufferFormat;
UINT BackBufferCount;
D3DMULTISAMPLE_TYPE MultiSampleType;
D3DSWAPEFFECT SwapEffect;
HWND hDeviceWindow;
BOOL Windowed;
BOOL EnableAutoDepthStencil;
D3DFORMAT AutoDepthStencilFormat;
DWORD Flags;
UINT FullScreen_RefreshRateInHz;
UINT FullScreen_PresentationInterval;
} D3DPRESENT_PARAMETERS;
</pre>

<b>Описание параметров.</b><br><br>

<b>BackBufferWidth</b> и <b>BackBufferHeight</b> – ширина и высота новых задних буферов, в пикселях. Если флажок Windowed установлен в FALSE (для полноэкранного режима), тогда эти значения (ширина и высота) должны быть взяты из функции <code>IDirect3D9::EnumAdapterModes</code>. Если флажок Windowed установлен в TRUE и любое из этих значений нуль, тогда размеры берутся из области клиента hDeviceWindow (или фокуса окна, если hDeviceWindow равен NULL).<br><br>

<b>BackBufferFormat</b> – это член структуры D3DFORMAT. Это значение одного из форматов визуализации, которое утверждается при помощи <code>IDirect3D9::CheckDeviceType</code>.<br>
Если установлен флажок Windowed в TRUE, тогда BackBufferFormat устанавливается по умолчанию текущего режима отображения. Для этого используйте функцию <code>IDirect3DDevice9::GetDisplayMode</code>, чтобы получить текущий формат.<br><br>

<b>BackBufferCount</b> – число задних буферов, их значение может быть 0, 1, 2, 3. Минимально считается наличие 1, поэтому при параметре 0, все равно создастся 1 задний буфер.<br><br>

<b>MultiSampleType</b> – член структуры D3DMULTISAMPLE_TYPE. Это значение должно быть равно <code>D3DMULTISAMPLE_NONE</code>, если SwapEffect был установлен в <code>D3DSWAPEFFECT_DISCARD</code>. Multisampling поддерживается, если был определен эффект обмена <code>D3DSWAPEFFECT_DISCARD</code>.<br><br>

<b>SwapEffect</b> – служит для определения обмена буферов. Член структуры D3DSWAPEFFECT. Если флажок Windowed установлен в TRUE и SwapEffect установлен в <code>D3DSWAPEFFECT_FLIP</code>, тогда добавится один дополнительный задний буфер и не будет отображаться, пока активен первичный буфер. <code>D3DSWAPEFFECT_COPY</code> и <code>D3DSWAPEFFECT_COPY_VSYNC</code> требует установить значение BackBufferCount в 1.  <code>D3DSWAPEFFECT_DISCARD</code> – будет прописано управляемое время в отладчике, когда любой буфер может быть заполнен, когда другой виден на экране.<br><br>

<b>hDeviceWindow</b> – если приложение работает в полноэкранном режиме, то задается вся поверхность экрана монитора.<br><br>

<b>Windowed</b> – Равен TRUE, если приложение запущено в оконном режиме. FALSE - если приложение является полноэкранным.<br><br>

<b>EnableAutoDepthStencil</b> – если значение TRUE, то Microsoft Direct3D может управлять буфером глубины. Устройство может создать трафарет буфера глубины. Трафарет буфера глубины автоматически устанавливается на устройство визуализации. Когда устройство сбрасывается, трафарет буфера глубины автоматически уничтожается и создается новый размер.<br>
Если EnableAutoDepthStencil установлен в TRUE, тогда AutoDepthStencilFormat должен иметь формат трафарета глубины.<br><br>

<b>AutoDepthStencilFormat</b> – может принимать значения из структуры D3DFORMAT. Создает формат поверхности трафарета глубины.<br><br>

<b>Flags</b> – он может быть установлен в 0, или в следующие флажки:
<p><code>D3DPRESENTFLAG_LOCKABLE_BACKBUFFER</code> - устанавливаем флаг, если приложение требует непосредственный режим работы с задним буфером. Обратите внимание, задние буфера имеют доступ, если приложение имеет <code>D3DPRESENTFLAG_LOCKABLE_BACKBUFFER</code>, когда использует функцию <code>IDirect3D9::CreateDevice</code> или <code>IDirect3DDevice9::Reset</code>.</p><br>

<b>FullScreen_RefreshRateInHz</b> – частота обновления экрана. Для оконного режима это значение должно быть 0. Иначе, это значение должен возвращать <code>IDirect3D9::EnumAdapterModes</code>. Можно использовать одно из следующих значений:
<p><code>D3DPRESENT_RATE_DEFAULT</code> - ставит по умолчанию, или текущему обновлению отображения окна.<br>
<code>D3DPRESENT_RATE_UNLIMITED</code> - ставит самый быстрый рефреш, которое позволяет железо.</p>

<p><b>FullScreen_PresentationInterval</b> – максимальный интервал переключений заднего буфера. Для оконного режима это значение можно установить в <code>D3DPRESENT_INTERVAL_DEFAULT(0)</code>. Для полноэкранного устанавливается в <code>D3DPRESENT_INTERVAL_DEFAULT</code> или может равняться одному из ниже описанных флажков входящих в структуру <code>D3DCAPS9</code>:
<p>
<code>D3DPRESENT_INTERVAL_IMMEDIATE</code> - позволяет действовать немедленно. Драйвер не ждет возврата вертикального луча синхронизации.<br>
<code>D3DPRESENT_INTERVAL_ONE</code> - драйвер ждет возврата вертикального луча синхронизации. Т.е. обновление происходит не быстрее чем обновление экрана.<br>
<code>D3DPRESENT_INTERVAL_TWO</code> - драйвер ждет возврата вертикального луча синхронизации. Т.е. обновление происходит в два раза медленнее, чем обновление экрана.<br>
<code>D3DPRESENT_INTERVAL_THREE</code> - драйвер ждет возврата вертикального луча синхронизации. Т.е. обновление происходит в три раза медленнее, чем обновление экрана.<br>
<code>D3DPRESENT_INTERVAL_FOUR</code> - драйвер ждет возврата вертикального луча синхронизации. Т.е. обновление происходит в четыре раза медленнее, чем обновление экрана. </p>
</div><br>

<div class="first_line"><img src="'. $site['setting']['base'] .'/img/plus.gif" align="absmiddle" height="9" width="9" border="0" onclick="moreinfo(\'img6\', \'elem6\');" id="img6"><b>HRESULT Clear(DWORD Count, CONST D3DRECT *pRects, DWORD Flags, D3DCOLOR Color, float Z, DWORD Stencil)</b></div>
<div id="elem6" style="display: none; margin-left: 20px">очищает окно, буфер глубины и буфер трафарета.<br><br>
<b>Count</b> – количество прямоугольников в массиве pRects, если указано 0, то будет очищена вся поверхность.<br><br>

<b>pRects</b> – указатель на массив структуры D3DRECT описывающий прямоугольную область очистки. Если Вам нужно очистить полностью экран укажите NULL.
<pre class="code">
typedef struct _D3DRECT
{
    LONG x1, y1;	//координаты верхнего левого угла
    LONG x2, y2;	//координаты нижнего правого угла
} D3DRECT;
</pre>
<b>Flags</b> – параметр, определяющий флаги, указывающие, какие из поверхностей должны быть очищены, комбинируется из следующих значений флагов:<br><br>
<code>D3DCLEAR_STENCIL</code> - очищает буфер трафарета до значения Stencil.<br>
<code>D3DCLEAR_TARGET</code> - очищает отображаемую часть экрана, цветом указанным в Color.<br>
<code>D3DCLEAR_ZBUFFER</code> - очищает буфер глубины, значением указанным в Z.<br><br>

<b>Color</b> – это значение имеет 32-битовый цвет, для очистки экрана приложения. Для задания используется макрос <code>D3DCOLOR_XRGB(R, G, B)</code><br><br>

<b>Z</b> – параметр задает значение для Z-буфера. 0.0 – самое близкое значение, 1.0 – дальнее расстояние<br><br>

<b>Stencil</b> – значение буфера трафарета, может быть в диапазоне от 0 до 2 в степени n-1, где n разрядная глубина буфера трафарета.<br><br>

<b>Возвращаемое значение.</b><br>
Если функция завершена успешно, тогда возвращается значение <code>D3D_OK</code>, иначе значение <code>D3DERR_INVALIDCALL</code>.
</div><br>

<div class="first_line"><img src="'. $site['setting']['base'] .'/img/plus.gif" align="absmiddle" height="9" width="9" border="0" onclick="moreinfo(\'img7\', \'elem7\');" id="img7"><b>HRESULT BeginScene(VOID)</b></div>
<div id="elem7" style="display: none; margin-left: 20px">
после этой функции начинается создание сцены.
</div><br>

<div class="first_line"><img src="'. $site['setting']['base'] .'/img/plus.gif" align="absmiddle" height="9" width="9" border="0" onclick="moreinfo(\'img8\', \'elem8\');" id="img8"><b>HRESULT EndScene(VOID)</b></div>
<div id="elem8" style="display: none; margin-left: 20px">
вызов этой функции сигнализирует, что сцена полностью помещена в задний буфер обмена и теперь может быть выведена на экран.
</div><br>

<div class="first_line"><img src="'. $site['setting']['base'] .'/img/plus.gif" align="absmiddle" height="9" width="9" border="0" onclick="moreinfo(\'img9\', \'elem9\');" id="img9"><b>HRESULT Present(CONST RECT *pSourceRect, CONST RECT *pDestRect, HWND hDestWindowOverride, CONST RGNDATA *pDirtyRegion)</b></div>
<div id="elem9" style="display: none; margin-left: 20px"><br>
<b>pSourceRect</b> – указатель на структуру RECT исходной поверхности. Если указатель NULL, то используется вся поверхность. Если прямоугольник имеет значения больше самой поверхности, то он подрезается до соответствующих размеров поверхности.<br><br>

<b>pDestRect</b> – указатель на структуру RECT поверхности адресата. Если указатель равен NULL, если не были указаны <code>D3DSWAPEFFECT_COPY</code> или <code>D3DSWAPEFFECT_COPY_VSYNC</code>. pDestRect является указателем на структуру RECT, содержащая координаты прямоугольника клиентского окна. Если указатель NULL, то используется полная область клиента. Если прямоугольник имеет значения больше самой поверхности, то он подрезается до соответствующих размеров поверхности.<br><br>

<b>hDestWindowOverride</b> – указатель указывающий на окно клиента, которая предназначена для визуализации сцены. Если этот параметр равен NULL, тогда hWndDeviceWindow входящий в структуру D3DPRESENT_PARAMETERS будет принят.<br>
<b>pDirtyRegion</b> – этот параметр не используется и должен быть установлен в NULL (использовался в предыдущих версиях, оставлен для совместимости).<br><br>
<b>Возвращаемое значение.</b>
Если функция завершена успешно, тогда возвращается значение <code>D3D_OK</code>.<br>
В случае ошибки возвращается одно из следующих значений:<br>
<code>D3DERR_INVALIDCALL</code><br>
<code>D3DERR_DEVICELOST</code>
</div><br>

<div class="first_line"><img src="'. $site['setting']['base'] .'/img/plus.gif" align="absmiddle" height="9" width="9" border="0" onclick="moreinfo(\'img10\', \'elem10\');" id="img10"><b>HRESULT CreateVertexBuffer(UINT Length, DWORD Usage, DWORD FVF, D3DPOOL Pool, IDirect3DVertexBuffer9 **ppVertexBuffer, HANDLE *pHandle)</b></div>
<div id="elem10" style="display: none; margin-left: 20px">
создание буфера вершин<br><br>
<b>Length</b> – размер буфера вершин в байтах.<br><br>
<b>Usage</b> – способ применения буфера вершин, в большинстве случаев используется 0, но можно использовать одно или несколько значений констант D3DUSAGE:<br><br>
<code>D3DUSAGE_DONOTCLIP</code> - указывает на то, что буфер вершин никогда не будет требовать переключение. Когда Вам нужно будет отобразить содержимое буфера, установите флажок <code>D3DRS_CLIPPING</code> в false (ложь).<br><br>
<code>D3DUSAGE_DYNAMIC</code> - указывает когда вершинам или буферу требует использование динамической памяти. Это разрешает драйверу самому решать куда разместить. Так, статический буфер вершин помещается в видео память, а динамический в AGP память. Если Вы не используете флажок <code>D3DUSAGE_DYNAMIC</code>, Вы тем самым назначаете использование статической памяти. <code>D3DUSAGE_DYNAMIC</code> строго прописывается через <code>D3DLOCK_DISCARD</code> и <code>D3DLOCK_NOOVERWRITE</code>. Флажки <code>D3DLOCK_DISCARD</code> и <code>D3DLOCK_NOOVERWRITE</code> влияют на вершины и буфер созданные при помощи <code>D3DUSAGE_DYNAMIC</code>; они не могут влиять на статический буфер вершин.<br><br>
<code>D3DUSAGE_RTPATCHES</code> - указывает, когда буфер вершин должен использовать прорисовку высококачественного примитива.<br><br>
<code>D3DUSAGE_NPATCHES</code> - указывает, когда буфер вершин использует прорисовку N кусков.<br>
<code>D3DUSAGE_POINTS</code> - указывает, когда буфер вершин использует прорисовку указателя на спрайт или список указателей.<br><br>
<code>D3DUSAGE_SOFTWAREPROCESSING</code> - указывает, когда буфер вершин использует программную обработку вершин.<br><br>
<code>D3DUSAGE_WRITEONLY</code> - сообщает системе, что пишет только буфер вершин. Использование этого флажка разрешает драйверу оптимизировать память для эффективной записи операций и визуализации. Пытается прочитать буфер вершин и затем создать.<br><br>
<b>FVF</b> – указывается формат вершин.<br><br>
<b>Pool</b> – описание формата вершин для размещения в памяти используя член перечисляемого типа.
</div><br>

<div class="first_line"><img src="'. $site['setting']['base'] .'/img/plus.gif" align="absmiddle" height="9" width="9" border="0" onclick="moreinfo(\'img11\', \'elem11\');" id="img11"><b>typedef enum _D3DPOOL</b></div>
<div id="elem11" style="display: none; margin-left: 20px">
<pre class="code">
typedef enum _D3DPOOL
{
  D3DPOOL_DEFAULT = 0,    //по умолчанию
  D3DPOOL_MANAGED = 1,    //ресурсы копируются автоматически в доступную для устройств память
  D3DPOOL_SYSTEMMEM = 2,  //использует системную оперативную память
  D3DPOOL_SCRATCH = 3,    //ресурс помещается в системную память и не обновляется 
                          //при потере устройства
  D3DPOOL_FORCE_DWORD = 0x7fffffff  //не используется
} D3DPOOL;
</pre>
<b>ppVertexBuffer</b> – указатель на адрес в котором будет храниться адрес создаваемого буфера вершин.<br><br>
<b>pHandle</b> – всегда устанавливайте в 0, это зарезервированный параметр.<br><br>
<b>Возвращаемое значение</b>.
Если функция завершена успешно, тогда возвращается значение <code>D3D_OK</code>, иначе:<br>
&nbsp;&nbsp;<code>D3DERR_INVALIDCALL</code><br>
&nbsp;&nbsp;<code>D3DERR_OUTOFVIDEOMEMORY</code><br>
&nbsp;&nbsp;<code>E_OUTOFMEMORY</code>
</div><br>

<div class="first_line"><img src="'. $site['setting']['base'] .'/img/plus.gif" align="absmiddle" height="9" width="9" border="0" onclick="moreinfo(\'img12\', \'elem12\');" id="img12"><b class="first_line">HRESULT Lock(UINT OffsetToLock, UINT SizeToLock, VOID **ppbData, DWORD Flags)</b></div>
<div id="elem12" style="display: none; margin-left: 20px">
блокировка диапазона вершин для получения указателя на память буфера вершин.<br><br>
<b>OffsetToLock</b> – указывает на границу данных вершин для блокировки, измеряется в байтах. Для того что бы заблокировать весь буфер используется  значение 0.<br><br>
<b>SizeToLock</b> – размер буфера для блокировки, если оба параметра установлены в NULL – блокируется весь буфер вершин.<br><br>
<b>ppbData</b> – означает адрес указателя на указатель с данными буфера вершин.<br><br>
<b>Flags</b> – описывает тип блокировки.<br>
&nbsp;&nbsp;<code>D3DLOCK_DISCARD</code> – блокируется каждое положение в пределах блокируемой области.<br>
&nbsp;&nbsp;<code>D3DLOCK_NO_DIRTY_UPDATE</code> – происходит «добавление» данных в память.<br>
&nbsp;&nbsp;<code>D3DLOCK_NO_SYSLOCK</code> – блокирует систему на большой промежуток времени.<br>
&nbsp;&nbsp;<code>D3DLOCK_READONLY</code> – приложение не будет записано в буфер.<br>
&nbsp;&nbsp;<code>D3DLOCK_NOOVERWRITE</code> – этот флаг исключает запись в буфер вершин при уже имеющихся данных в буфере.
</div><br>

<div class="first_line"><img src="'. $site['setting']['base'] .'/img/plus.gif" align="absmiddle" height="9" width="9" border="0" onclick="moreinfo(\'img13\', \'elem13\');" id="img13"><b class="first_line">HRESULT Unlock(VOID)</b></div>
<div id="elem13" style="display: none; margin-left: 20px">
разблокировка буфера вершин.
</div><br>

<div class="first_line"><img src="'. $site['setting']['base'] .'/img/plus.gif" align="absmiddle" height="9" width="9" border="0" onclick="moreinfo(\'img17\', \'elem17\');" id="img17"><b class="first_line">HRESULT SetStreamSource(UINT StreamNumber, IDirect3DVertexBuffer9 *pStreamData, UINT OffsetInBytes, UINT Stride)</b></div>
<div id="elem17" style="display: none; margin-left: 20px">
связывание буфера вершин с потоком данных устройства.<br><br>
<b>StreamNumber</b> – определяет проток данных от 0 до -1.<br><br>
<b>pStreamData</b> – указатель на создаваемый буфер вершин, который связывается с потоком данных.<br><br>
<b>OffsetInBytes</b> – смещение от начала потока, да начала вершин в байтах. Если установить в 0, вывод будет происходить начиная с первой вершины.<br><br>
<b>Stride</b> – размер структуры задающей вершину.
</div><br>

<div class="first_line"><img src="'. $site['setting']['base'] .'/img/plus.gif" align="absmiddle" height="9" width="9" border="0" onclick="moreinfo(\'img14\', \'elem14\');" id="img14"><b class="first_line">HRESULT SetFVF(DWORD FVF)</b></div>
<div id="elem14" style="display: none; margin-left: 20px">
установка формата вершин.
</div><br>

<div class="first_line"><img src="'. $site['setting']['base'] .'/img/plus.gif" align="absmiddle" height="9" width="9" border="0" onclick="moreinfo(\'img15\', \'elem15\');" id="img15"><b class="first_line">HRESULT DrawPrimitive(D3DPRIMITIVETYPE PrimitiveType, UINT StartVertex, UINT PrimitiveCount)</b></div>
<div id="elem15" style="display: none; margin-left: 20px">
<br>
<b>PrimitiveType</b> – перечисляемый тип D3DPRIMITIVETYPE, описывающий тип примитива для вывода на экран.<br>
<img src="'. $site['setting']['base'] .'/img/plus.gif" align="absmiddle" height="9" width="9" border="0" onclick="moreinfo(\'img16\', \'elem16\');" id="img16"><b class="first_line">typedef enum _D3DPRIMITIVETYPE</b>
<div id="elem16" style="display: none; margin-left: 20px">
<pre class="code">
{
	D3DPT_POINTLIST = 1,      //определяет вершины, как набор точек
	D3DPT_LINELIST = 2,       //определяет вершины, как список прямых линий
	D3DPT_LINESTRIP = 3,      //определяет вершины, как отдельную ломаную линию
	D3DPT_TRIANGLELIST = 4,   //каждая группа 3х вершин определяет отдельный треугольник
	D3DPT_TRIANGLESTRIP = 5,  // отображает указанные вершины как несколько треугольников
	                          // связанных между собой
	D3DPT_TRIANGLEFAN = 6,    // отображает треугольники, вершины которого 
	                          // представляют вид веера
	D3DPT_FORCE_DWORD = 0x7fffffff  //значение не используется
} D3DPRIMITIVETYPE;
</pre>
</div>
<br><br><b>StartVertex</b> – индекс первой вершины для загрузки.<br><br>
<b>PrimitiveCount</b> – количество выводимых примитивов.
</div>
';
	break;
//-------------------------------------------------------------------------------------------------------

case '0906/08.html':
	$site['page']['title'] .= ' - Программирование с использованием DirectX9';
	$site['page']['description'] .= ' Программирование с использованием DirectX9.';
	$site['page']['keywords'] .= ', Программирование DirectX9, использование DirectX9';
	$site['page']['body'] = '<h1>Программирование с использованием DirectX9</h1>
<b>Автор:</b> <a href="http://forum.sources.ru/index.php?showuser=9930"><i>orb</i></a><br><br>
<b>Приложение к статье:</b> <a href="'. $site['setting']['base'] .'/0906/08_enclosure.html">Справочник использованных функций</a>.

<p>
<b>От автора.</b><br><br>
Начиная с этого номера журнала, выйдет серия статей, посвященных основам программирования трехмерных приложений на С++ и использованию библиотеки DirectX 9. Каждая статья будет разбита на две части:
<ol type="1">
<li>Краткое описание некоторых возможностей DirectX 9, включая исходные коды программы. В конце статьи будет прилагаться задание для лучшего усвоения материала.</li>
<li>Приложение, в котором будут более детально рассмотрены применяемые функции, с описанием переменных и их возможных значений.</li>
</ol>
Все вопросы, замечания, комментарии, советы всегда можно обсудить на форуме <a href="http://forum.sources.ru">forum.sources.ru</a> в соответствующих разделах. Редколлегия будет признательна читателям в помощи и развитии направления программирования 3D.
</p>

<h2>Введение</h2>
<p>Причиной появления библиотеки DirectX явилась медлительность стандартных графических средств ОС Windows. Кроме того, разработчику сложно предугадать оборудование пользователя, который будет играть в игру, тем более что в наше время оборудование обновляется чуть ли не каждый день. Выходом из ситуации стала разработка библиотек для работы с графикой. Наиболее популярные - OpenGL и DirectX. Выбора между этими библиотеками делать не будем. Многие специалисты отдают предпочтение OpenGL, другие DirectX. На форумах и конференциях идут обсуждения, перечисляются преимущества и недостатки каждой.</p>

<p><b>OpenGL</b> – Open Graphic Library, открытая графическая библиотека. Термин «открытый» означает «независимый от производителей». Библиотеку OpenGL могут производить  разные фирмы и отдельные разработчики, главное, чтобы она удовлетворяла спецификации (стандарту) OpenGL и ряду тестов. Процедуры OpenGL работают как с растровой, так и с векторной графикой и позволяют создавать двух- и трехмерные объекты произвольной формы. Для объекта может быть задан материал и наложена растровая текстура. Объектами сцен также являются источники света. Вдобавок в библиотеке OpenGL имеются средства взаимодействия графических объектов, которые позволяют создавать эффекты прозрачности, тумана, смешивания цветов, выполнять логические операции над объектами, передвигать объекты сцены, лампы и камеры по заданным траекториям и т.д.</p>
<p><b>DirectX</b> – это мультимедийная библиотека, позволяющая напрямую работать с аппаратным обеспечением компьютера в обход традиционных средств платформы Win32. Вся DirectX делится на компоненты, отвечающие за ту или иную часть работы библиотеки:</p>
<i>DirectX Graphics</i> – объединяет компоненты DirectDraw и Direct3D для работы с двух- и трёхмерной графикой. Библиотека спроектирована так, что она может использовать все аппаратные возможности видеокарты по обработке графики. Если какие-то требуемые возможности не реализованы аппаратно, то они эмулируются программно.<br>
<i>DirectInput</i> – взаимодействие с устройствами ввода (мышь, клавиатура, джойстик, руль, ....).<br>
<i>DirectAudio</i> – объединяет компоненты DirectMusic и DirectSound. Компонент предназначен для работы с устройствами воспроизведения звука, работает значительно быстрее стандартных MCI-функций Windows, позволяет синхронизировать происходящее на экране со звуковыми эффектами, дает возможность замедлять и ускорять воспроизведение, смешивать звуки, создавать объемные звуковые эффекты.<br>
<i>DirectPlay</i> – сетевая связь между компьютерами.<br>
<i>DirectShow</i> – программирование мультимедийных приложений, обеспечивает высококачественный захват и проигрывание  мультимедийных потоков данных.<br>
<i>DirectSetup</i> – инсталляция компонентов DirectX.

<h2>Рассмотрим подробнее DirectX.</h2>

<p>DirectX включает в себя уровень абстракции – HAL (Hardware Abstraction Layer). С помощью HAL происходит взаимодействие приложения с оборудованием компьютера, вне зависимости от изготовителя оборудования. Это дает возможность написанному коду работать на любом аппаратном обеспечении без внесения параметров этого оборудования.</p>

<br>
<div align="center">
<img border="0" width="643" height="70" src="'. $site['setting']['base'] .'/img/m/0906/08/hal.gif" align="center">
</div>

<p>Вся библиотека DirectX построена на основе СОМ (Component Object Model). Вам не придется углубляться в сущность этой технологии, так как вся работа с СОМ основана на вызовах соответствующих функций. В составе СОМ имеется API, называемая СОМ-библиотекой; с её помощью достигается управление всеми компонентами. Каждый из программных компонентов реализует определенное количество СОМ-объектов, доступ к которым осуществляется посредством интерфейсов, которые, в свою очередь состоят из функций. С помощью этих функций и происходит взаимодействие с СОМ-объектом.</p>

<h2>Построение сцены</h2>
<p>Прежде чем начать программировать, нужно четко представлять схему построения сцены.
<ol type="1">
<li><b>Создание оконного приложения.</b> Часть программы взаимодействующая с Windows.</li>
<li><b>Инициализация Direct3D.</b> Создание интерфейсов, инициализация 3D устройств, настройка программной и аппаратной части компьютера.</li>
<li><b>Создание объекта.</b> Ввод координат вершин треугольников из которых состоит объект, назначение формата вершин для последующей трансформации.</li>
<li><b>Освещение, назначение материала, наложение текстур.</b> Создание источников освещения и наложение текстур на объекты сцены.</li>
<li><b>Рендер сцены.</b> Отрисовка всех объектов с учетом освещения, угла обзора, видимости объектов, падающих теней ... До этого мы только вводили параметры всех составляющих, а теперь видеокарта производит расчет и вывод на экран всей сцены.</li>
</ol>
Конечно, на эти этапы делить создание трехмерного приложения можно только условно, но все же такое разложение помогает понять в общих чертах создание приложения.</p>

<h2>Создание оконного приложения</h2>
<p>Прежде чем приступить к программированию графики с помощью DirectX, необходимо создать каркас программы. Каркас приложения это самое простое Windows приложение, его описание пропустим из-за того, что оно рассмотрено во всех книгах программирования под Windows, и описание можно найти на многих сайтах в Интернете. Главное отличие - это вывод на экран, мы не используем сообщение <code>WM_PAINT</code>, а обработка сообщений выглядит следующим образом:</p>
<pre class="code">
while(msg.message!=WM_QUIT)
	{
		if(PeekMessage(&msg, NULL, 0, 0, PM_REMOVE))
		{
			TranslateMessage(&msg);
			DispatchMessage(&msg);
		}else
			RenderScene();
	}
</pre>
<p>Создаем цикл, выход из которого возможен при получении сообщения <code>WM_QUIT</code>.<br>
Вместо привычной функции <code>GetMessage</code> используем <code>PeekMessage</code>, которая предназначена для работы в режиме реального времени. Т.е. постоянно сканируется очередь сообщений, если таковые есть, они обрабатываются, иначе вызывается функция <code>RenderScene()</code> в которой происходит создание и вывод сцены на экран.</p>

<h2>Инициализация DirectX</h2>

<p>Для начала необходимо подключить заголовочный файл.<br>
Теперь необходимо подключить библиотеку <i>d3d9.lib</i>, ее можно подключить в свойствах проекта или явно подключить с использованием команды препроцессора #pragma. Разницы никакой нет, используем второй способ:</p>
<pre class="code">
#pragma comment(lib, "d3d9.lib")
</pre>

<p>Создадим функцию, в которой будут инициализироваться интерфейсы DirectX:</p>
<pre class="code">
bool InitDirectX(void).
</pre>

<p>Создаем глобальные переменные:<br>
<i>LPDIRECT3D9 pDirect3D</i> - указатель на главный интерфейс. Это первый объект, который необходимо создать, только после этого можно получить доступ ко всем остальным интерфейсам.<br>
<i>LPDIRECT3DDEVICE9 pDirectDevice</i> - интерфейс устройства Direct3D.</p>

<p>Для удобства создадим функцию <code>InitDirectX()</code>, в которой будем инициализировать устройства 3D.</p>

<pre class="code">
bool InitDirectX(void)
{
	if((pDirect3D=Direct3DCreate9(D3D_SDK_VERSION)) == NULL)
		return(false);
	D3DDISPLAYMODE stDisplay;
	if(FAILED(pDirect3D->GetAdapterDisplayMode(D3DADAPTER_DEFAULT, &stDisplay)))
		return(false);
	D3DPRESENT_PARAMETERS Direct3DParametr;
	ZeroMemory(&Direct3DParametr, sizeof(Direct3DParametr));
	Direct3DParametr.Windowed=TRUE;
	Direct3DParametr.SwapEffect=D3DSWAPEFFECT_DISCARD;
	Direct3DParametr.BackBufferFormat=stDisplay.Format;
	if(FAILED(pDirect3D->CreateDevice(D3DADAPTER_DEFAULT, D3DDEVTYPE_HAL, 
	          hWnd, D3DCREATE_HARDWARE_VERTEXPROCESSING, &Direct3DParametr, &pDirectDevice)))
		return(false);
	return(true);
}
</pre>


<code>pDirect3D=Direct3DCreate9(D3D_SDK_VERSION)</code> - создается основной указатель на интерфейс IDirect3D9. Всегда используется один макрос <code>D3D_SDK_VERSION</code>, указывающий на текущую версию SDK.

<p>Для проверки результата выполнения функции используется макрос <code>FAILED()</code>, который проверяет код на наличие сбоя. Работает по схеме:</p>

<pre class="code">
if(FAILED(…))
{	сбой	}
else
{	функция выполнена успешно	}
также можно использовать макрос SUCCEEDED, по такой схеме
if(SUCCEEDED(…))
{	функция выполнена успешно	}
else
{	сбой	}
</pre>

<p>Теперь нужно получить текущие параметры дисплея с помощью функции <code>GetAdapterDisplayMode()</code>.<br>
Создаем структуру параметров представления <code>D3DPRESENT_PARAMETERS Direct3DParametr</code> и задаем значения:</p>

<br>
<code>Direct3DParametr.Windowed=TRUE;</code> - оконный режим работы приложения.<br>
<code>Direct3DParametr.SwapEffect=D3DSWAPEFFECT_DISCARD;</code> - не использовать буфера обмена.<br>
<code>Direct3DParametr.BackBufferFormat=stDisplay.Format;</code> - формат видеорежима заднего буфера устанавливаем равным текущему видеорежиму.

<p>Создаем объект интерфейса <code>CreateDevice</code>. Все дальнейшие действия будут опираться на данный интерфейс устройства и его параметры.</p>

<br>
<code>D3DADAPTER_DEFAULT</code> - текущая видеокарта (обычно в системе установлена 1 видеокарта).<br>
<code>D3DDEVTYPE_HAL</code> - выбор способа обработки информации, с помощью видеокарты.<br>
<code>hWnd</code> - дескриптор главного окна.<br>
<code>D3DCREATE_HARDWARE_VERTEXPROCESSING</code> – способ обработки вершин (в данном случае аппаратно). Можно использовать значение <code>D3DCREATE_SOFTWARE_VERTEXPROCESSING</code> – программная обработка вершин (при использовании старых видеокарт).<br>
<code>&amp;Direct3DParametr</code> - параметры видеорежима.<br>
<code>&amp;pDirectDevice</code> - результат операции, указатель на только что созданный объект.

<h2>Функция для рендеринга сцены</h2>

<p>В этой части кода происходит вывод изображения на экран</p>

<pre class="code">
void RenderScene(void)
{
	if(pDirectDevice==NULL)
		return;
	pDirectDevice->Clear(0, NULL, D3DCLEAR_TARGET, D3DCOLOR_XRGB(0, 192, 0), 1.0f, 0);
	pDirectDevice->BeginScene();
	pDirectDevice->EndScene();
	pDirectDevice->Present(NULL, NULL, NULL, NULL);
}
</pre>

<p>Сначала необходимо очистить задний буфер  и заполнить все пространство одним цветом:

<pre class="code">
Clear(0, NULL, D3DCLEAR_TARGET, D3DCOLOR_XRGB(0, 192, 0), 1.0f, 0)
</pre>

Создание сцены происходит между строками:
<pre class="code">
	pDirectDevice->BeginScene();
	pDirectDevice->EndScene();
</pre>

Все что в этом блоке, прорисовывается в заднем буфере.<br>
Теперь осталось вывести содержимое заднего буфера на экран:

<pre class="code">
pDirectDevice->Present(NULL, NULL, NULL, NULL)
</pre>
</p>

<p>На данный момент у нас есть полностью работоспособная оболочка для создания 3D приложения. Создать новый проект Win32, Empty и добавить <a href="'. $site['setting']['base'] .'/img/m/0906/08/window1.cpp">этот файл (window1.cpp)</a>. Можно компилировать и запускать (для выхода нужно нажать любую клавишу). Так как мы ничего не рисовали, то на экране нет ни одного объекта. Все что было проделано это инициализация устройств и очистка экрана в темно-зеленый цвет. Насладившись результатами работы, нажимаем любую кнопку для выхода из программы и приступаем к рисованию объектов.</p>

<h2>Создание объекта</h2>

<p>Если посмотреть на схему создания 3D сцены, получится что пропущены шаги - создание объекта и применение материалов с освещением. Освещение и материалы прибережем на следующую статью, а объект создать нужно!<br>
Сначала определимся, что же рисовать? – сердечко.<br>
Все объекты при программировании в 3D состоят из частей. Самая простая фигура из которой можно составить любую другую – это треугольник. Какая бы не была у Вас мощная видеокарта, но все объекты в играх она строит из треугольников!!!<br>
Разобьем наше сердечко на треугольники, пытаясь максимально сохранить формы сердца, при этом использовать минимальное количество треугольников. В этом задании нужно знать меру и помнить: «Чем больше треугольников – тем КРАСИВЕЕ выглядит объект, и ДОЛЬШЕ его обрабатывает компьютер». Сразу хочу Вас успокоить, при создании очень сложных объектов состоящих из сотен или тысяч треугольников, вручную вам их разбивать не придется, для этого есть специализированные программы 3DMax, Maya и др.<br>
Вот что получилось у меня</p>

<br>
<div align="center">
<img border="0" width="400" height="412" src="'. $site['setting']['base'] .'/img/m/0906/08/heart.gif">
</div>

<p>Получилось 7 треугольников. Каждый треугольник имеет кроме координат 3х вершин еще и параметр преобразования и цвет вершины, поэтому создадим структуру, которая будет определять все характеристики вершин:

<pre class="code">
struct CUSTOMVERTEX					//формат вершин
{
	FLOAT x, y, z, rhw;
	DWORD color;
};
</pre></p>

<p>С помощью строки:

<pre class="code">
#define D3DFVF_CUSTOMVERTEX (D3DFVF_XYZRHW|D3DFVF_DIFFUSE)
</pre>

описывается формат содержания вершин в отдельном потоке данных. Здесь применяется гибкий формат вершин – FVF (Flexible Vertex Format). Все перечисленные элементы совпадают с объявленными в структуре. <code>D3DFVF_DIFFUSE</code> – указывает на то, что применяется цветовая составляющая с рассеянным цветом.<br>
Всю работу по подготовке буфера будем делать в отдельной функции:
<pre class="code">
bool InitBufferVertex(void);
</pre>
Все вершины будут храниться в буфере вершин. При заполнении буфера данными его необходимо предварительно заблокировать, после заполнения данным – разблокировать.<br>
Определяем указатель на буфер вершин:
<pre class="code">
LPDIRECT3DVERTEXBUFFER9 pBufferVertex=NULL;
</pre>
И введем координаты всех вершин в формате структуры:</p>

<br><br>
<table border="0" cellspacing="0" cellpadding="5" align="center">
<tr><th>координаты (Х, Y, Z)</th><th>параметр преобразования</th><th>цвет</th></tr>
<tr align="middle"><td colspan="3" class="c2">первый</td></tr>
<tr align="middle"><td class="c1">170,  80, 0</td><td class="c1">1</td><td class="c1">0x00ff0000</td></tr>
<tr align="middle"><td class="c1">210,  60, 0</td><td class="c1">1</td><td class="c1">0x00ff0000</td></tr>
<tr align="middle"><td class="c1">250,  80, 0</td><td class="c1">1</td><td class="c1">0x00ff0000</td></tr>
<tr align="middle"><td colspan="3" class="c2">второй</td></tr>
<tr align="middle"><td class="c1">170,  80, 0</td><td class="c1">1</td><td class="c1">0x00ff0000</td></tr>
<tr align="middle"><td class="c1">250,  80, 0</td><td class="c1">1</td><td class="c1">0x00ff0000</td></tr>
<tr align="middle"><td class="c1">275, 130, 0</td><td class="c1">1</td><td class="c1">0x00ff0000</td></tr>
<tr align="middle"><td colspan="3" class="c2">третий</td></tr>
<tr align="middle"><td class="c1">170,  80, 0</td><td class="c1">1</td><td class="c1">0x00ff0000</td></tr>
<tr align="middle"><td class="c1">275, 130, 0</td><td class="c1">1</td><td class="c1">0x00ff0000</td></tr>
<tr align="middle"><td class="c1">150, 130, 0</td><td class="c1">1</td><td class="c1">0x00ff0000</td></tr>
<tr align="middle"><td colspan="3" class="c2">четвертый</td></tr>
<tr align="middle"><td class="c1">300,  80, 0</td><td class="c1">1</td><td class="c1">0x00ff0000</td></tr>
<tr align="middle"><td class="c1">340,  60, 0</td><td class="c1">1</td><td class="c1">0x00ff0000</td></tr>
<tr align="middle"><td class="c1">380,  80, 0</td><td class="c1">1</td><td class="c1">0x00ff0000</td></tr>
<tr align="middle"><td colspan="3" class="c2">пятый</td></tr>
<tr align="middle"><td class="c1">300,  80, 0</td><td class="c1">1</td><td class="c1">0x00ff0000</td></tr>
<tr align="middle"><td class="c1">380,  80, 0</td><td class="c1">1</td><td class="c1">0x00ff0000</td></tr>
<tr align="middle"><td class="c1">275, 130, 0</td><td class="c1">1</td><td class="c1">0x00ff0000</td></tr>
<tr align="middle"><td colspan="3" class="c2">шестой</td></tr>
<tr align="middle"><td class="c1">275, 130, 0</td><td class="c1">1</td><td class="c1">0x00ff0000</td></tr>
<tr align="middle"><td class="c1">380,  80, 0</td><td class="c1">1</td><td class="c1">0x00ff0000</td></tr>
<tr align="middle"><td class="c1">400, 130, 0</td><td class="c1">1</td><td class="c1">0x00ff0000</td></tr>
<tr align="middle"><td colspan="3" class="c2">седьмой</td></tr>
<tr align="middle"><td class="c1">150, 130, 0</td><td class="c1">1</td><td class="c1">0x00ff0000</td></tr>
<tr align="middle"><td class="c1">400, 130, 0</td><td class="c1">1</td><td class="c1">0x00ff0000</td></tr>
<tr align="middle"><td class="c1">275, 360, 0</td><td class="c1">1</td><td class="c1">0x00ff0000</td></tr>
</table>

<p>Создаем буфер вершин:</p>
<pre class="code">
CreateVertexBuffer(21*sizeof(CUSTOMVERTEX), 0, D3DFVF_CUSTOMVERTEX, D3DPOOL_DEFAULT, &pBufferVertex, NULL)
</pre>

<p>указываем размер, формат и передаем указатель, где будет храниться информация.<br>
Как я говорил выше, перед записью данных в буфер его необходимо заблокировать, а только после этого копировать данные:</p>
<pre class="code">
if(FAILED(pBufferVertex->Lock(0, sizeof(stVertex), (void**)&pBV, 0)))
		return(false);
	memcpy(pBV, stVertex, sizeof(stVertex));
	pBufferVertex->Unlock();	//разблокировать буфер для дальнейшей работы
</pre>

<h2>Рендеринг объекта</h2>
<p>Вывод всех объектов сцены на экран происходит в функции рендеринга между строками</p>
<pre class="code">
	pDirectDevice->BeginScene();
	pDirectDevice->EndScene();
</pre>

<p>Заполним этот промежуток.<br> 
Укажем, какие данные пересылать в поток данных устройства, также указываем размер данных, определяющий одну вершину:</p>

<pre class="code">
SetStreamSource(0, pBufferVertex, 0, sizeof(CUSTOMVERTEX));
SetFVF(D3DFVF_CUSTOMVERTEX);				// задаем формат вершин
</pre>

<p>Выводим объект, для этого используем функцию вывода примитивов (примитив – любая геометрическая фигура).<br>
Передаем в качестве параметров такие значения:</p>

<pre class="code">
DrawPrimitive(D3DPT_TRIANGLELIST,  // что рисовать
              0,                   // индекс первой вершины
              7                    // количество выводимых объектов
              );
</pre>

<p>Готово!!! (<a href="'. $site['setting']['base'] .'/img/m/0906/08/heart.cpp">листинг программы heart.cpp</a>)<br>
На экране результат: сердечко.</p>

<p><i>Примечание:</i> При написании статьи я умышленно опустил детальное описание функций, что бы не нагружать ненужной пока информацией. Полное описание использованных функций можно найти в приложении к статье или других источниках, например, MSDN.</p>

<p>Для усвоения материала предлагаю выполнить небольшое задание: нарисовать смайлик, результаты можно выложить <a href="http://forum.sources.ru/index.php?showtopic=154721">на форуме</a>.<br><br>
Если у Вас возникли проблемы, вопросы или пожелания к статье – милости просим в <a href="http://forum.sources.ru/index.php?showtopic=154721">тему поддержки этой статьи</a>.<br><br>
<div align="right" style="font-style: italic">С уважением, orb. <a href="http://vseok.org.ua/">(сайт автора)</a></div>
</p>
';
	break;
//-------------------------------------------------------------------------------------------------------

case '0906/09.html':
	$site['page']['title'] .= ' - Создание личного веб-сервера: основные понятия и технологии';
	$site['page']['description'] .= ' Создание личного веб-сервера: основные понятия и технологии.';
	$site['page']['keywords'] .= ', Создание веб-сервера';
	$site['page']['body'] = '<h1>Создание личного веб-сервера: основные понятия и технологии</h1>
<b>Автор:</b> <a href="http://forum.sources.ru/index.php?showuser=33097"><i>polyglott</i></a>
<h2>Предисловие</h2>
<p>Эта статья не просто объясняет, что такое веб-сервер, зачем он нужен и как работает, но и проводит читателя по пути создания своего собственного сервера, так что читатель впоследствии сам сможет дать устраивающий его ответ на все эти вопросы.</p>
<h2>Вступление</h2>
<p>Каждый новый пользователь интернета достаточно рано начинает понимать, что появляющаяся в его навигаторе информация скачивается с сервера. Также он очень быстро усваивает, что разные сайты, скорее всего, расположены на разных серверах. Но что такое сервер, как он выглядит, и как отличить его от любого другого предмета, знают, оказывается, далеко не все. Рассказы людей, видевших сервер своими глазами, интригуют. Из этих рассказов можно понять, что сервер - это суперкомпьютер с двумя процессорами, расположенный в специальном подвале под замком, а всемогущий администратор регулярно "тельнетится" к своему детищу, чтобы просматривать логи и отражать хакерские атаки, подобно герою звёздных войн. Всё это правда, но количество вопросов она не уменьшает.</p><br>
<p>Провести ликбез я предлагаю радикальным способом: создайте свой веб-сервер. Причём не уступающий функционально серверу, к примеру, "яндекса". Вы скоро убедитесь, что это не требует денежных затрат и по силам каждому. Нам потребуется только персональный компьютер под управлением операционной системы Windows 2000 (Pro, Server) или похожей (XP, 2003) и соединение с интернетом. Я уверен, что лет через 20 в мире (или, как сейчас модно говорить, "на рынке") личных серверов с личными сайтами будет столько же, сколько сейчас мобильных телефонов.</p>

<h2 align="center">Что такое сервер</h2>
<p>Начнём с определения. <i>Сервер (от to serve - служить) - это программа, способная принимать запросы от других программ и выдавать им ответ; то есть, обслуживающая другие программы.</i> Предположим, что у нас есть программа calc.exe, способная понимать запросы в виде математических выражений и выдавать результат вычисления этих выражений. Это будет самый что ни на есть типичный сервер! <i>Программа, способная делать запросы к другой программе и получать от неё ответ, называется клиентом.</i></p><br>
<p>Кроме того, "сервером" часто называют компьютер, на котором запущена программа-сервер и основная роль которого - эту программу выполнять. Компьютер-сервер совсем не обязан быть мощным. Но если он обрабатывает сотни запросов в секунду, то мощным ему быть не помешает, чтобы клиенту не пришлось слишком долго ожидать отклика. Кстати, такая ситуация уже несколько лет существует на сервере, адресуемом narod.yandex.ru - файлы с него качаются очень медленно (особенно из-за границы).</p><br>
<p><i>Веб-сервер</i> - это серверная программа, обрабатывающая запросы по протоколу HTTP. Протокол HTTP регламентирует вид запросов на получение гипертекстовой информации и вид ответов на эти запросы. Роль клиентов веб-серверов чаще всего играют навигаторы, но ими также могут быть менеджеры закачек и разные другие программы. Когда вы набираете в адресной строке навигатора "http://rambler.ru", он делает запрос HTTP к соответствующему серверу с просьбой получить главную страницу, а полученную страницу отображает в своём окне.</p><br>
<p>В слове "веб-сервер" приставку "веб-" часто отбрасывают для краткости, что вносит окончательную неразбериху в терминологию. Давайте для ясности вспомним, что термином "сервер" обозначают: программу-сервер, компьютер-сервер, а в частных случаях - программу-веб-сервер, компьютер-веб-сервер, программу-сервер баз данных и т.д.</p>
<h2 align="center">Теория и практика клиентсерверного взаимодействия</h2>
<p>Итак, смысл жизни программы-сервера - обслуживать программы-клиенты. Как одна программа может обратиться к другой? Современные операционные системы (Windows, *NIX и др.) предоставляют для этих целей два основных средства: каналы (pipes) и сокеты (по-русски - розетки). Причём при помощи сокетов (я буду употреблять этот американизм по причине всеобщего непонимания русских слов) клиент может обратиться не только к серверу, запущенному на том же компьютере, где он сам, но и к расположенному на другом компьютере, доступ к которому происходит через сеть. Все сетевые протоколы (HTTP, FTP,...) предполагают клиент-серверное взаимодействие только через сокеты.</p><br>
<p>Любая программа может открыть сокет, присвоив ему номер, называемый номером порта. Между двумя любыми открытыми сокетами (портами) возможно перетекание информации. Как правило, сервер открывает порт с постоянным номером (чтобы клиенты всегда знали, куда обращаться) в самом начале своей работы, а клиент открывает порт с произвольным меняющимся номером (если один номер занят - выбирается другой) непосредственно перед транзакцией и закрывает порт после неё. Некоторые программы сочетают в себе функции сервера и клиента, например, ICQ в качестве сервера ожидает новые сообщения, а в качестве клиента сама посылает сообщения другому экземпляру ICQ, запущенному на другом компьютере.</p><br>
<p>Кстати, из-за внутренней ошибки программа может выдать не то, что у неё запросили. Например, та же ICQ (а ошибок в ней тьма) может вдруг выдать удалённому клиенту содержимое какого-нибудь файла на вашем компьютере (а этот файл может содержать какой-нибудь ваш пароль).</p><br>
<p>Какие порты открыты у вас в данный момент, и кто к ним подключен, можно посмотреть в фаирволе (если ваша фаирволь поддерживает такую возможность) или утилитой "fport". Если запустить ICQ, то в списке портов вы обнаружите что-то вроде "ICQLITE.EXE TCP all:4752", то есть, открыт порт 4752 (проверьте).</p><br>
<p>Номер порта можно назвать адресом программы внутри компьютера. Но для осуществления межсокетной коммуникации нужно ещё знать адрес компьютера внутри сети. Каждый компьютер тоже имеет номер, называемый адресом IP. Адрес IP - 4-байтное число. Чаще всего каждый байт записывают отдельно через точку, например "1.2.3.4", хотя можно и в шестнадцатеричном или восьмеричном виде, например "0x01020304".</p><br>
<p>Адреса от 127.0.0.0 до 127.255.255.255 зарезервированы для работы внутри собственного компьютера, и адрес 127.0.0.1 практически всегда адресует собственный компьютер. Адреса в диапазонах 10.0.0.0 - 10.255.255.255, 172.16.0.0 - 172.31.0.0 и 192.168.0.0 - 192.168.255.0 адресуют компьютеры в локальной сети. Куда вы попадёте, набирая эти адреса, зависит от того, к каким компьютерам ведёт провод, выходящий из вашей сетевой карты, от конфигурации этих компьютеров, но, самое главное, от их наличия (отсутствия), и от наличия самой сетевой карты :) Если адрес компьютера не входит в вышеупомянутые диапазоны, значит, мы имеем дело с компьютером во внешней сети (интернет). [1].</p><br>
<p>Теперь я предлагаю сделать HTTP-запрос к какому-нибудь серверу, например, к серверу, запущенному на компьютере с адресом 1.2.3.4 и открывшему порт номер 80. Для того, чтобы делать любые запросы к любому серверу, используйте программу telnet, входящую в дистрибутив Windows. Откройте командную строку и напишите:</p>

<pre class="outpp">telnet 1.2.3.4 80</pre>
<p>Скорее всего, эта попытка провалится, так как мала вероятность того, что в сети окажется сервер с таким адресом. Поэтому нужно узнать адрес какого-нибудь существующего сервера. Для этого используем утилиту ping, тоже изначально имеющуюся в Windows. Напишем:</p>
<pre class="outpp">ping ya.ru</pre>
<p>...и увидим на экране примерно следующее:</p>
<pre class="outpp">Обмен пакетами с ya.ru [213.180.204.8] по 32 байт:

Ответ от 213.180.204.8: число байт=32 время=449мс TTL=57
Ответ от 213.180.204.8: число байт=32 время=369мс TTL=57
Ответ от 213.180.204.8: число байт=32 время=546мс TTL=57
Ответ от 213.180.204.8: число байт=32 время=639мс TTL=57

Статистика Ping для 213.180.204.8:
    Пакетов: отправлено = 4, получено = 4, потеряно = 0 (0% потерь),
Приблизительное время передачи и приема:
    наименьшее = 369мс, наибольшее =  639мс, среднее =  500мс</pre>
<p>Как вы догадались, анализируя увиденное, 213.180.204.8 - это адрес IP сервера ya.ru. Если вы видите какой-нибудь другой адрес, это означает, что он изменился с тех пор, как я написал статью. Подтельнетимся к тому адресу, который у вас получился, и 80му порту:</p>
<pre class="outpp">telnet 213.180.204.8 80</pre>
<p>Сделав это, вы (в зависимости от версии вашего тельнета) могли увидеть пустой экран. Напечатайте в нём запрос, который хотите послать серверу. Например:</p>
<pre class="outpp">GET / HTTP/1.0</pre>
<p>Не смущайтесь, если набираемый вами текст не показывается на экране. В конце надо сделать два перевода строки. И результат должен быть примерно таким:</p>

<pre class="outpp">
HTTP/1.0 200 OK
Server: thttpd/2.25b 29dec2003
Content-Type: text/html; charset=windows-1251
Date: Mon, 16 Jan 2006 09:10:33 GMT
Last-Modified: Fri, 13 Jan 2006 11:32:57 GMT
Accept-Ranges: bytes
Connection: close
Content-Length: 2003

&lt;html&gt;
      &lt;head&gt;
            &lt;title&gt;Яndex&lt;/title&gt;
                                &lt;link rel="SHORTCUT ICON" href="/favicon.ico" /&gt;
&lt;base target="_top" /&gt;
...</pre>
<p>Кстати, тельнету можно давать не только адреса IP, но и доменные имена, он сам определит, какой адрес соответствует имени:</p>
<pre class="outpp">telnet ya.ru 80</pre>
<p>Но почему 80, спросите вы? Потому что мы заранее знаем, что веб-сервер ya.ru ждёт подключений на 80м порту, так как, набрав в навигаторе "http://ya.ru:80", мы получаем от сервера ответ (а набрав "http://ya.ru:81", не получаем). В адресе формата "URL" номер порта записывается после имени хоста через двоеточие. Если порт не указан, то навигатор (и большинство других программ) автоматически подставляет значение по умолчанию. Для протокола HTTP это значение - 80. Таким образом, две нижеследующие строки эквивалентны:Но почему 80, спросите вы? Потому что мы заранее знаем, что веб-сервер ya.ru ждёт подключений на 80м порту, так как, набрав в навигаторе "http://ya.ru:80", мы получаем от сервера ответ (а набрав "http://ya.ru:81", не получаем). В адресе формата "URL" номер порта записывается после имени хоста через двоеточие. Если порт не указан, то навигатор (и большинство других программ) автоматически подставляет значение по умолчанию. Для протокола HTTP это значение - 80. Таким образом, две нижеследующие строки эквивалентны:</p>
<pre class="outpp">http://ya.ru
http://ya.ru:80</pre>
<p>Когда вы наберете такой адрес в навигаторе, последний сделает точно такой же запрос к серверу ya.ru (порт 80), какой мы сделали с помощью тельнета. Кстати, вы знали, что вместо имени хоста можно указать IP?</p>
<pre class="outpp">http://213.180.204.8
http://213.180.204.8:80</pre>
<p>...а можно IP в шестнадцатеричном или восьмеричном представлении...</p>
<pre class="outpp">http://0xD5B4CC08
http://0xD5B4CC08:80
http://032555146010
http://032555146010:80</pre>
<p>Для справки: портом по умолчанию для протокола SMTP является 25, POP3 - 110, FTP (данные) - 20, FTP (управление) - 21, NNTP - 119... [2].</p>
<h2 align="center">Установка и настройка серверного ПО</h2>
<p>Вы уже поняли, что такое веб-сервер и как с ним работать. А теперь я предлагаю вам превратить свой компьютер в сервер, чтобы с ним можно было работать так же, как со всеми остальными серверами. Для этого, как вы знаете, на вашем компьютере надо запустить программу, обрабатывающую HTTP-запросы. Писать такую программу мы с вами сейчас не будем (как-нибудь в другой раз), а установим одну из уже готовых. Программ веб-серверов много в мире, но самые распространённые - это Internet Information Services (IIS) и Apache. Пользователям Windows 2000 лучше всего подходит IIS, потому что он интегрирован в операционную систему, и именно о нём я буду рассказывать. Apache хорош для *NIX-ов, если он вас интересует, обратитесь к сайту dklab.ru.</p><br>
<p>Для установки IIS зайдите в меню "пуск", выберите "настройка", и откройте "панель управления". Вызовите "установка и удаление программ". Нажмите на кнопку "добавление и удаление компонентов Windows". Теперь вы должны видеть "мастер компонентов Windows" со списком компонентов, которые можно отмечать птичкой (галочкой), и среди них должен быть IIS. Выделите IIS, и нажмите кнопку "состав". В составе отметьте птичками все компоненты, которые считаете полезными (можно вообще все). Главное - отметить "веб-сервер", "документация", "общие файлы", и "оснастка IIS". Можете выбрать FTP-сервер, если он вам нужен, хотя особой пользы от него, если есть HTTP-сервер, я не вижу. А вот "служба SMTP" - очень полезная вещь (правда о ней я в этой статье не рассказываю).</p><br>
<p>После проделанных действий сервер должен начать работать. Чтобы убедиться в этом, наберите в навигаторе адрес своего компьютера (http://127.0.0.1). Должна появиться страница по умолчанию. Она называется Default.asp и находится в папке %SystemDrive%\Inetpub\wwwroot (например, c:\Inetpub\wwwroot). Всё содержимое этой папки теперь доступно программам-клиентам, в том числе через интернет. Например файл icon1.png (если он там есть) будет доступен по адресу "http://127.0.0.1/icon1.png". Я рекомендую стереть всё, что Билл Гейтс положил вам в эту папку (или перенести куда-нибудь, чтобы потом изучать), и наполнить её чем-нибудь своим. Помните, что файл с именем Default.html, а если его нет, то Default.asp (обязательно с заглавной буквы), открывается по умолчанию.</p><br>
<h2 align="center">Администрирование веб-сервера</h2>
<p>Администрирование веб-сервера IIS включает в себя изменение следующих параметров:</p>
<br>
<li>Порт сервера (по умолчанию 80)</li>
<li>Домашний каталог (по умолчанию %SystemDrive%\Inetpub\wwwroot)</li>
<li>Документ, открываемый по умолчанию (изначально Default.html или Default.asp)</li>
<li>Разрешение запуска сценариев и программ</li>
<li>Разрешение просмотра содержимого папок</li>
<li>Выставление прав доступа к документам</li>
<li>Создание виртуальных каталогов</li>
<li>Определение, необходимо ли вести лог (журнал) и какие данные в нём протоколировать</li>
<li>Другое</li>
<p>Администрирование осуществляется при помощи "оснастки IIS". Оснастку можно вызвать, зайдя в панель управления, дважды щёлкнув "администрирование", а затем "диспетчер служб интернета". Перед вами раскроется древовидная структура, корнем которой будет сетевое имя вашего компьютера (вероятно, заданное во время инсталляции операционной системы). Этим именем можно адресовать ваш компьютер в локальной сети. Одним из подэлементов корня должен быть "веб-узел по умолчанию". Выделив его, вы увидите (в правом кадре) список всех файлов, доступных для скачивания с вашего сервера. Чтобы ограничить доступ к какому-нибудь файлу, щёлкните по его названию правой кнопкой мыши и выберите пункт "свойства". В появившемся диалоговом окне всё вполне прозрачно, и вы сами сможете в нём разобраться. Кстати, щёлкнув правой кнопкой мыши по "веб-узел по умолчанию", вы тоже вызовете меню с пунктом "свойства".</p><br>

<h2 align="center">Эксплуатация веб-сервера</h2>
<p>Конечно, ваш сервер доступен всему миру только тогда, когда ваш компьютер включен и соединён с интернетом; а полноценный публичный сервер должен быть доступен круглосуточно. Чтобы обратиться к вашему компьютеру, удалённый клиент должен адресовать вас по вашему внешнему IP-адресу (127.0.0.1 сработает только с вашего собственного компьютера, а адрес типа 10.11.12.13 только с компьютера в вашей локальной сети). Внешний IP можно определить на странице ip.xss.ru (или на любой другой, позволяющей определить IP). Если IP у вас постоянный, то клиентам достаточно знать его, чтобы всегда иметь возможность к вам подключиться. Но это сопряжено с кое-какой проблемой: ни одно живое существо на свете никогда ваш адрес IP не запомнит. Есть и ещё парочка неприятных нюансов: некоторые поисковые системы откажутся индексировать ваш сайт, а письма, отправленные с вашего SMTP-сервера, автоматически попадут в категорию "спам".</p><br>
<p>Выйти из ситуации можно, приобретя доменное имя (domain name). Доменные имена - это имена наподобие "google.com", каждое из которых ассоциировано с определённым IP. Чтобы перевести доменное имя в IP, операционная система использует серверы DNS (Domain Name Service), которые обычно расположены у провайдеров интернета.</p><br>
<p>Доменное имя на самом деле состоит из нескольких имён, разделённых точкой. Самое правое называется именем первого уровня, или зоной. Есть зоны общие (com, net, org, info) есть тематические (edu, gov, mil, biz, travel), а есть - региональные (ru, ua, us, ca, uk и др). Слева от имени первого уровня идёт имя второго уровня, затем третьего и т.д. Владелец имени уровня n может создавать неограниченное количество любых имён уровня n+1 внутри своего.</p><br>
<p>Правами на каждую зону владеет определённая коммерческая организация, зарегистрированная в ICANN. Эта организация продаёт имена второго уровня (около $15/год). Информация об именах в каждой зоне (например, цены и правила, которым должны подчиняться сайты в данной зоне) чаще всего доступна на сайте администрации зоны. Этот сайт как правило имеет адрес "nic." плюс имя зоны (например "nic.com", "nic.ru"). Домены третьего уровня можно найти бесплатные.</p><br>
<p>Приобретя домен, вы сможете связать его со своим адресом IP. Если ваш IP изменится, вы должны будете внести изменения в настройки домена. Эти изменения будут сообщены всем серверам DNS на земном шаре, что займет около суток.</p><br>
<p>Сегодня у провайдеров интернета распространена практика выдавать пользователю новый адрес IP при каждом новом соединении со шлюзом, поэтому у подавляющего большинства пользователей интернета динамический (часто меняющийся) IP. Что делать в таком случае? Можно воспользоваться услугами служб динамических имён, таких как dyndns.com. DynDNS позволяет управлять доменом второго или третьего уровня, связывая домен с постоянным или динамическим IP. В случае с динамическим IP вам предложат использовать специальную программу DynDNS Updater, которая будет отслеживать изменение IP и автоматически посылать новое значение на сервер DynDNS. Изменение IP вступает в силу мгновенно, а не спустя сутки, как в случае с обычными доменными именами (см. выше). Вы можете иметь один аккаунт на DynDNS бесплатно.</p><br>
<p>После того, как вы создадите сервер, обзаведётесь для него доменным именем и сделаете на нём свой сайт, вы, наверное, захотите, чтобы ваш сайт начали посещать. Как люди узнают о нём? Чаще всего люди узнают о сайте после того, как попадут на него с поисковой машины. Поисковые машины узнают о новом сайте либо когда владелец сайта явно им об этом сообщает (<noindex><a href="http://www.google.com/addurl" rel="nofollow">google.com/addurl</a>, <a href="http://webmaster.yandex.ru" rel="nofollow">webmaster.yandex.ru</a>, <a href="http://www.rambler.ru/doc/add_site.shtml" rel="nofollow">rambler.ru/doc/add_site.shtml</a></noindex>), либо самостоятельно найдя новый сайт по ссылке. Могу вам сказать, что я свой сайт в поисковики не добавлял, но указал пару раз его адрес при заполнении формы в одной гостевой книге (это была гостевая книга очень раскрученного сайта). Спустя две-три недели у меня в серверных логах начали появляться следы роботов, индексирующих сайты.</p><br>
<p>Первое, что делает индексирующий робот - запрашивает файл "robots.txt" из корневой директории сервера. Если этот файл отсутствует, то ваш сайт будет проиндексирован (целиком, если так решит робот). Если robots.txt существует, то он должен содержать информацию о том, какие части сайта каким роботам индексировать нельзя. Синтаксис этого файла описан на странице <noindex><a href="http://www.robotstxt.org/wc/exclusion-admin.html" rel="nofollow">www.robotstxt.org/wc/exclusion-admin.html</a></noindex>.</p><br>
<p>На своём сервере функционально вы ни в чём не ограничены и можете установить всё, что угодно: форум (например, популярный бесплатный форум "phpbb"), базу данных, или сервер знакомств. У обладателей собственного сервера намного больше возможностей, чем у владельцев платного хостинга на общем сервере. Ваши скрипты могут прибегать к помощи любых программ. Но делая свой сервер, вы берёте на себя заботу о его безопасности. Помните, преступник, взломавший ваш компьютер, может получить или испортить любые данные на вашем жестком диске.</p><br>
<p>Напоследок хочу пожелать вам, чтобы ваш сайт внёс весомый вклад в культурную жизнь интернета! Удачи!</p><br>
<h2 align="center">Литература</h2>
<p>[1] Linux Network Administrators Guide (Olaf Kirch) <noindex><a href="http://sec.pmg17.vn.ua/teacher/nag-20/lnag.htm" rel="nofollow">http:/sec.pmg17.vn.ua/teacher/nag-20/lnag.htm</a></noindex><br>
[2] Программирование на Java. 1001 совет. (Марк С. Чен, Стивен В. Грифис, Энтони Ф. Изи)</p>
<p style="text-align: right;"><i>С уважением, <a href="http://forum.sources.ru/index.php?showuser=33097" target="_blank">polyglott</a>!</i></p>
';
	break;
//-------------------------------------------------------------------------------------------------------

case '0906/10.html':
	$site['page']['title'] .= ' - Реалистичные сигареты';
	$site['page']['body'] = '<h1>Реалистичные сигареты</h1>
<b>Переводчик:</b> <a href="http://forum.sources.ru/index.php?showuser=15180"><i>MIF</i></a>
<p>Бросаете курить? Устали от нашлепок, жвачки, таблеток и других замен никотина? Ну, хорошо, если уже невмоготу без табака, давайте создадим сигарету. Дело займет Ваши руки, и Вы на какое-то время забудете о курении. Это помогло мне бросить курить (по крайней мере, помогло начать...). Запустите Фотошоп, и если у Вас есть настойчивость, желание и сила воли, то Вы сможете наслаждиться результатами.</p>

<p><b>Шаг 1. Основа.</b> Создайте новый документ произвольного размера. Добавьте прозрачный слой поверх фона, активируйте его и с помощью инструмента Rectangular Marquee (Прямоугольная область), создайте новую область с отношением длины к высоте 10:1. Залейте область белым цветом (#FFFFFF). Добавьте еще один слой, назовите его "Фильтр", выделите область 3:1 на одном из концов белой полосы и залейте ее желто-коричневым цветом (#D79311). У вас должно получиться что-то, напоминающее картинку.</p>
<div align="center"><img src="'. $site['setting']['base'] .'/img/m/0906/10/step1.jpg" border="0"></div>

<p><b>Шаг 2 - Текстура.</b> Создайте новый слой поверх всех остальных и залейте его белой краской (не волнуйтесь, ваша сигарета скоро начнет приобретать законченную форму). Откройте опцию Noise (Filter > Noise > Add Noise, Фильтр > Шум > Добавить шум), измените значение amount на 400% и выделите опцию monochromatic (монохромный). Теперь изменяйте масштаб слоя "Фильтр", пока не получите картинку, похожую на эту:</p>
<div align="center"><img src="'. $site['setting']['base'] .'/img/m/0906/10/step2.jpg" border="0"></div>
<p>Теперь выделите слой "Фильтр", инвертируйте выделение и нажмите Delete. Выберите color burn (затемнение основы) тип смешения слоя "Шум" и 6% Opacity (Непрозрачность). Создайте новый слой и в точности повторите все операции, но в этот раз измените масштаб чуть-чуть. Активируйте основной слой, инвертируйте выделение и нажмите "Delete". Переместите этот слой под слой "Фильтр".</p>

<p><b>Шаг 3 - Реалистичность.</b> Закончили предыдущие шаги? Хорошо, двигаемся дальше. Создайте новый слой поверх всех остальных и назовите его "Градиент". Выделите слой "Сигарета", созданный в самом начале. Заполните его белым цветом о поставьте уровень Opacity (Непрозрачность) 38%. Кликните правой кнопкой мыши слой "Градиент" и выберите опцию Blending Options (Наложение градиента). Создайте градиент, как на картинке и нажмите кнопку ОК.</p>
<div align="center"><img src="'. $site['setting']['base'] .'/img/m/0906/10/step3.jpg" border="0"></div>

<p><b>Шаг 4 - Наведение лоска.</b> Мы почти закончили проект. Осталось лишь добавить маленькие детали. Создайте еще один слой и назовите его "Верхний". Возьмите инструмент Pencil (Карандаш) и измените цвет рисования на темно-коричневый (#3F2100). Теперь добавим небольшие штрихи. Выберите более светлый оттенок и добавьте маленькие детальки на конце сигареты, как показано на рисунке</p>
<div align="center"><img src="'. $site['setting']['base'] .'/img/m/0906/10/step4.jpg" border="0"></div>

<p>А теперь создайте новый слой и выделите область шириной 2 пикселя (ширина зависит от того, насколько велика Ваша сигарета). Заполните область белым цветом и оставьте Opacity (Непрозрачность) 100%. Теперь приложите черный Outer Glow (Внешнее свечение) к основному слою (примерный размер - 7 пикселей) и поставьте opacity 18%. Также можете добавить текст для персонализации полученного результата. Все! Закончили!</p>
<div align="center"><img src="'. $site['setting']['base'] .'/img/m/0906/10/finished.jpg" border="0"></div>

<p>Конечно, Вы можете пойти дальше. Если Вам понравилось, то попытайтесь создать целую пачку сигарет. Наслаждайтесь!</p>
<p style="text-align: right;"><i>С уважением, <a href="http://forum.sources.ru/index.php?showuser=15180" target="_blank">MIF</a>!</i></p>
';
	break;
//-------------------------------------------------------------------------------------------------------

case '0906/11.html':
	$site['page']['title'] .= ' - Собственный IcoSet';
	$site['page']['body'] = '<h1>Собственный IcoSet</h1>
<b>Автор:</b> <a href="http://forum.sources.ru/index.php?showuser=29474"><i>Green Light</i></a>

<h2>Вопросы стиля и методы реализации.</h2>
<p>Для знающего человека слово «icoset» говорит само за себя. В этом слове «ico» означает «icon» – значок, иконка, а «set» – установка. Понятие «установка значков» применимо ко многим «отраслям продукции»,  таким как программные проекты, оболочки ОС, web-сайты и многое другое. В этой статье рассматриваются основные аспекты стиля, вопросы, касающиеся разработки и методы реализации.<br><br>
Итак, начнем. Иконки. Почти все видят их каждый день в окнах операционных систем (кроме консольных ?), они на панелях инструментов, в меню, на web-страницах… Иконки являются неотъемлемой частью дизайна интерфейса любого программного продукта. За много лет работы у пользователя появилась возможность менять их, подбирать на свой вкус. Появились так называемые «темы». Однако, понятие icoset – гораздо более обширное, оно включает в себя не столько набор элементов, сколько объединение их по стилю. Кому-то этот стиль нравится, кому-то нет, а кто-то вообще их игнорирует. Так чем же определяется стиль?</p>

<h2 align="center">Вопросы стиля</h2>

<p>Стиль Icoset`а ограничен возможностями той среды, где он применяется. Например, если брать Windows до XP, то можно легко вспомнить 256-цветные ужастики на рабочем столе и т.д. Следовательно, при разработке пакета, например для Stardock Icon Packager необходимо учесть этот нюанс. Дело в том, что программное средство, с помощью которого вы рисуете, наверняка поддерживает 32-хбитный цвет с прозрачностью. Стиль также определяется наличием или отсутствием определенных качеств, о которых и пойдет речь далее. Итак, рассмотрим поближе…<br><br>
При задумке нового проекта учитываются многие аспекты: где он будет применяться, для чего служит, насколько тесно контактирует с пользователями и т.д. В общей сложности может получиться внушительный список вопросов, которые необходимо учесть при разработке. Те, кто разрабатывают программы в одиночку, наверняка особо не задумываются об этом сразу. В более многочисленных группах, где существует разделение обязанностей, и где, как правило, есть дизайнер, эта забота спадает с плеч программистов. Теперь будем говорить с дизайнерами.<br><br>
Выше вскользь  упоминались аспекты стиля разрабатываемых графических элементов. Что ж, если условия позволяют выплеснуться духу творчества, то это замечательно, если же нет, приходится выкручиваться…<br><br></p>
<h2>1. Основные аспекты стиля. </h2>
<p>Их очень много. Если честно, профессиональный дизайнер сам должен выбирать их для себя и учитывать при создании графики. Хотя, на самом деле они очевидны, и их можно перечислить:</p>
<br>
<li>Общая строгость стиля. Это касается количества прорисовываемых деталей, количества цветов (не палитры, а визуальных).</li>
<li>Материал. Да, это так. Надо подумать, из чего ваять иконки. Они могут быть как стеклянными, так и бумажными (или пластмассовыми)</li>
<li>Освещение. Подумайте, обрисовывать ли тени и отблески?</li>
<li>Цветовая схема стиля. На какой цвет делается акцент?</li>
<li>Ориентация изображений в пространстве. Как вы будете рисовать значки: лежащими на экране или повернутыми?</li>
<li>Объемность. Будете ли вы использовать эффекты теней и выпуклостей?</li>
<li>Четкость и плавность линий. Хотите ли размытое или резкое изображение... вам решать.</li>
<div align="center"><img src="'. $site['setting']['base'] .'/img/m/0906/11/1.png" border="0"><br>Разные материалы. Черновые примеры.</div>
<h2>2. Рекомендации по стилю значков файлов.</h2>
<p>Значки файлов можно сделать весьма разнообразными, однако не стоит забывать о кое-какой закономерности. При разработке Icoset для ОС желательно объединить сходные типы mime в группы.<br><br>
Значки определенной группы, как правило, сходятся. Это необходимо для удобства пользователя. Однако для различия типа файлов делают совершенно нехитрое: вводят различающийся элемент. Это может быть как цвет определенной детали изображения, так и написание расширения файла на самой иконке. Не бойтесь комбинировать.<br><br>
Эти приемы отнюдь не новы и очень распространены.  К сожалению, в стандартном icoset Windows этого нет, зато любой заметит это в icoset`ах Gnome и KDE. Вот устный пример реализации:</p><br>

<li>Допустим, вы хотите создать несколько иконок для музыкальных файлов. Для этого, если вы консерватор, и файл для вас – это листок, то за основу берите его.</li>
<li>Цвет и положение листка не меняйте.</li>
<li>Выберите в качестве различающегося элемента, например, ноты на листке.</li>
<li>От типа к типу меняйте цвет нот: (MP3 – темно-синий, WAV – зеленый и так далее)</li>
<li>Очень эффектно выглядит написание типа файла на листочке или на выноске.</li>

<p>PS: На значках слева используется реально написанный код программы HELLO WORLD, только уменьшенный.
Там написано:</p>
<pre class="code">    #include &lt;stdio.h&gt;
int main() {
	printf("Hello, World!");
	// This is program text for sources.ru icoset
	return 0;
}</pre>
<div align="center"><img src="'. $site['setting']['base'] .'/img/m/0906/11/2.png" border="0"><br>Вполне готовые значки файлов языков программирования.</div>
<h2>3. Стиль папок. </h2>
<p>Еще раз стоит напомнить: не забывайте о концепции. Стиль папок лучше всего приблизить к стилю значков файлов. Но здесь речь пойдет уже не только о папках ОС. <br><br>
Итак, допустим, пиктограммы папок будут использоваться в новом файловом менеджере с анализатором контента папок. И тогда спрашивается, зачем этот анализатор контента, и где его использовать? Программист сразу ответит: «Выводить сообщение о преобладающих типах в строке состояния. Или выписывать его рядом с папкой». У дизайнера может быть другое мнение на этот счет. Для него разумнее будет создать несколько стилей папок с разными изображениями файлов в них. К примеру, для пустого каталога можно нарисовать закрытую папку, или открытую, но пустую. Для папки с рисунками целесообразно создать открытую папку со значком файла изображения внутри. Это придает наглядность файловой системе, тем самым, облегчая работу с файловым менеджером и ускоряя навигацию по дискам.
Это же можно применить и к оболочке ОС. Больше сказать здесь нечего.</p>
<br>
<div align="center"><img src="'. $site['setting']['base'] .'/img/m/0906/11/3.png" border="0"><br>Черновые примеры папок.</div>
<h2>4. Стиль устройств.</h2>
<p> Последняя, довольно большая группа значков – значки устройств. Если вы усвоили азы, которые надо бы понимать при создании icoset, то придумать стиль устройства труда не составит. Но тут необходимо сказать одну вещь: если вы не можете выбрать определенный стиль для оборудования, то выполните его серым цветом. Это будет и смотреться неплохо и не повредит ЛЮБОМУ стилю.<br><br>
Если начинающий дизайнер будет следовать ХОТЯ БЫ ЭТИМ ПОНЯТИЯМ, то он сможет создавать все более зрелые решения и совершенствовать свои знания, что, в конечном счете, может принести успех коллективному или индивидуальному проекту.</p><br>
<div align="center"><img src="'. $site['setting']['base'] .'/img/m/0906/11/4.png" border="0"><br>Моя гордость - стеклянная флешка</div><br>
<h2 align="center">Методы реализации</h2>
<p>Здесь я бы хотел поделиться некоторыми методами и приемами реализации «стильных штучек» на примере программы <noindex><a href="http://www.awicons.com/" rel="nofollow">AWIcons PRO (9.02).</a></noindex> </p>
<p>Начинающим пользователям часто не удается выполнить какие-либо операции, и они отступают, бросая дело и увлечение. Здесь приведены материалы и приемы работы.</p>
<h2>1. Послойное построение изображения.</h2>
<b>Очень важно для новичков! В AWIcons нет слоев, так что лучше почитать...</b>
<ol>
<li>Рисуем контур папки и заливаем его градиентом. Дублируем изображение.</li>
<li>Поверх нарисованного контура рисуем крышку папки другим, отличным цветом.</li>
<li>Стираем вокруг крышки контур папки, заливаем background черным (отличным) цветом, а крышку делаем прозрачной (ПКМ).</li>
<li>Готовим прозрачный градиент, если хотим полиэтиленовую, прозрачную крышку. Заливаем крышку, а черный цвет убираем (ПКМ).</li>
<li>Отдельно рисуем то, что будет лежать в папке. В данном случае серый листок.</li>
<li>Делаем градиент и обводку линией с антиалиайзингом.</li>
<li>Копируем готовый листик в картинку с контуром папки (1).</li>
<li>Затем копируем крышку туда же (Закрываем папку).</li>
<li>Делаем обводку.</li>
<li>И небольшая ретушь.</li>
</ol>
<p>Здесь, по сути, черновая работа, я мог и аккуратнее :)<br>
На самом деле, роль слоев здесь выполняет дублирование изображений перед последующим шагом, раздельное рисование деталей, послойное наложение. Обратите внимание на рисунок 8: под крышкой виден лист. Такое легче всего сделать в редакторе, поддерживающем слои: просто поставить альфа-канал и настроить прозрачность. Здесь этот эффект достигается при помощи вышеперечисленных приемов и альфа-градиента.<br><br>
Прозрачность выделенной области в AWicons PRO 9 также можно установить и в эффекте "непрозрачность", просто открутив ползунок в обратную сторону.<br><br>
Но именно окно градиента дает настоящие возможности. Возможен плавный переход от прозрачности к матовости (на 10 изображении листок словно пропадает по крышкой внизу).<br><br>
Как я делал обводку, см. ниже.</p>
<div align="center"><img src="'. $site['setting']['base'] .'/img/m/0906/11/5.png" border="0"></div><br>
<h2>2. Антиалиайзинг и обводка</h2>
<p>На небольших изображениях (48Х48 и меньше) обводка становится громоздкой и неаккуратной. Это особенно заметно на рисунке 9: линии обводки, несмотря на задумку, выглядят очень жирными.<br><br>
Утончение линий можно совершить двумя способами:</p>

<ol>
<li>Включить антиалиайзинг, удерживая ПКМ, стереть с помощью прозрачной линии лишнюю толщину.</li>
<li>Через "непрозрачность". Это более опасный способ. Если слегка подвинуть ползунок вправо, то линия обводки станет гуще и насыщеннее. Затем пускаем в ход способ 1. Опасность заключается в том, что непрозрачность может испортить другие детали изображения.</li>
</ol>
<p>Применение обводки совершенно необязательно. В данном случае она была предусмотрена стилем, однако зубчатые края тоже выглядят некрасиво (рисунок 5). Если позволяют условия эксплуатации (а в Windows 9x, 2k они не позволяют) и вы не хотите делать обводку, но желаете иметь приятный внешний вид, то:<br><br>
- выбрав в качестве цвета прозрачность (чтоб стирала до прозрачного фона, как в способе 2) и линию, аккуратно пройдитесь по зазубренным краям. Единственное, это эффективно на более-менее прямых участках.
</p>
<h2>3. Масштабирование и цветность.</h2>
<p>В AWicons присутствует масштабирование с интерполяцией, но оно решает гораздо больше задач. И с ним много проблем. <br><br>
Здесь я могу поделиться FAQ’ом из жизни:</p><br>
<p><b>Q</b>: Как мне избежать лишних потерь размера при масштабировании, например с 64Х64 до 48Х48
<b>A</b>: Все гениальное просто:</p>
<ol>
<li>Для этого замеряем габариты самой картинки. Допустим 61Х52.</li>
<li>Двигаем ее в левый верхний угол, чтобы касалась краев.</li>
<li>После этого уменьшаем размер поля до 61Х61 - как раз под размер картинки</li>
<li>Двигаем ее к центру.</li>
<li>Масштабируем.</li>
</ol>
<p>Суть в том, чтобы перед масштабированием оставить минимум свободного места.<br><br>

<b>Q</b>: Команда "Создать стандартные форматы из текущего" очень коробит маленькие картинки (16Х16)<br>
<b>A</b>: Запомните: даже самые маленькие картинки всегда получайте из одного оригинала - самого большого. Дело в том, что это команда масштабирует цепочкой.<br><br>

<b>Q</b>: При масштабировании в 256 цветов картинка чересчур уродуется.<br>
<b>A</b>: Попробуйте провести операцию уменьшения цветности перед масштабированием<br><br>

<b>Q</b>: При урезке цветности до 16 цветов слишком много белых точек.<br>
<b>A</b>: Попробуйте провести более мягкую постеризацию и уменьшение цветности перед операцией. Попробуйте затемнить градиент.<br><br>

<b>Q</b>: Как уменьшить ступенчатость градиента при урезке до 256 цветов?<br>
<b>A</b>: Сохраните картинку в GIF файл и импортируйте обратно. Да. Это тупой, но рабочий способ! При сохранении программа создает палитру доминирующих цветов взамен стандартной.<br><br>

Эти советы пригодятся и в других программах.
</p>
<p style="text-align: right;"><i>С уважением, <a href="http://forum.sources.ru/index.php?showuser=29474" target="_blank">Green Light</a>!</i></p>
';
	break;
//-------------------------------------------------------------------------------------------------------

}

