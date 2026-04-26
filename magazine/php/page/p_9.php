<?php

$site['page']['block_number_mag'] = '<div class="block_menu"><div class="text">
<h4>Последний выпуск</h4>
	&nbsp;&raquo;&nbsp;<a href="'. $site['setting']['base'] .'/1009/irrlicht_engine.html">Использование Irrlicht Engine</a><br>
	&nbsp;&raquo;&nbsp;<a href="'. $site['setting']['base'] .'/1009/visual_c_vb_lugin.html">Visual C++ 6/Visual Basic 6: Работа с плагинами</a><br>
	&nbsp;&raquo;&nbsp;<a href="'. $site['setting']['base'] .'/1009/asing_programing.html">Асинхронное программирование</a><br>
	&nbsp;&raquo;&nbsp;<a href="'. $site['setting']['base'] .'/1009/motchet.html">Менеджер отчётов</a><br>
	&nbsp;&raquo;&nbsp;<a href="'. $site['setting']['base'] .'/1009/pascal_to_delphi.html">Секреты Delphi или переход с Pascal’я</a><br>
	&nbsp;&raquo;&nbsp;<a href="'. $site['setting']['base'] .'/1009/linekorn.html">О феномене ложных корней систем линейных алгебраических уравнений</a><br>
	&nbsp;&raquo;&nbsp;<a href="'. $site['setting']['base'] .'/1009/tech_lang.html">Научно-технический язык</a><br>
	&nbsp;&raquo;&nbsp;<a href="'. $site['setting']['base'] .'/1009/Symfony.html">Введение в PHP фреймворки: Symfony</a><br>
	&nbsp;&raquo;&nbsp;<a href="'. $site['setting']['base'] .'/1009/cms_drupal.html">CMS Drupal</a><br>
	&nbsp;&raquo;&nbsp;<a href="'. $site['setting']['base'] .'/1009/open_source.html">Мир Open source</a><br>
	&nbsp;&raquo;&nbsp;<a href="'. $site['setting']['base'] .'/1009/real_drop_water.html">Реалистичные капли воды</a><br>
</div></div>';


switch ($site['page']['url']) {

case '1009/irrlicht_engine.html':
	$site['page']['title'] .= ' - Использование Irrlicht Engine';
	$site['page']['description'] .= ' Использование Irrlicht Engine';
	$site['page']['keywords'] .= ', Использование Irrlicht Engine, библиотека Irrlicht Engine';
	$site['page']['body'] .= '<h1>Использование Irrlicht Engine</h1>
<b>Автор:</b> <noindex><a href="http://forum.sources.ru/index.php?showuser=41301" rel="nofollow" target="_blank"><i>impik777</i></a></noindex>
<p>Irrlicht Engine - кроссплатформенный графический 3D движок с открытым исходным кодом. Полностью бесплатен как для коммерческого, так и для некоммерческого использования. Основной автор движка, Nikolaus Gebhardt, разрабатывает его с 2002 года. Движок сочетает в себе универсальность, переносимость и широкую функциональность. Официальный сайт проекта: <noindex><a href="http://irrlicht.sourceforge.net/" rel="nofollow">http://irrlicht.sourceforge.net/</a></noindex><br>
Иррлихт – это кроссплатформенная библиотека. Имеется поддержка большей части операционных систем семейства Windows, а также Linux, MacOS и Solaris. Для успешного рендеринга на всех названных платформах, Иррлихт поддерживает несколько видов графического API: DirectX 8.1, DirectX 9.0, OpenGL (до версии 2.0) и имеет два собственных софтварных рендера.</p>
<h4>Краткий список возможностей</h4>
<ol>
	<li> Поддержка 8ми форматов текстур и около 2х десятков форматов мешей.</li>
	<li> Поддержка пиксельных и вершинных шейдеров до версии 3.0. Поддержка HLSL и GLSL.</li>
	<li> Particle systems и Billboards.</li>
	<li> Bump и Parallax mapping.</li>
	<li> Динамическое освещение и динамические тени.</li>
	<li> Light maps.</li>
	<li> Туман.</li>
	<li> Terrain и water surfaces.</li>
	<li> Развитая система GUI, включающая до 2х десятков элементов.</li>
	<li> Встроенный XML парсер.</li>
	<li> Работа с zip и pak архивами, а также многое другое.</li>
</ol>
<p>Иррлихт был написан на С++, однако уже имеются порты на .Net и Java. На движке уже выпушено большое количество как коммерческих, так и некоммерческих игр, а также проектов другого типа.<br>
Главное достоинство Иррлихт - простота его интерфейса, а также возможность работы с ним без знания тех разделов математики, которые обычно необходимы при программировании 3D графики. Для работы необходимо скачать SDK с официального сайта. Последняя версия на 25.12.07 - 1.4.<br>
Имеет Иррлихт также и один недостаток: полигоны мешей не хранятся в вершинных буферах в видеопамяти, а каждый раз при отрисовке загружаются в неё по шине из оперативной памяти, поэтому движок не тянет сильно нагруженные сцены вне зависимости от «крутизны» видеокарты. Сгладить этот недостаток можно, например, определяя вручную, какие меши видны данной камере, а остальные делая «невидимыми». Такой способ хорошо подходит к играм с камерой «от третьего лица сверху» (например, рпг и стратегии).</p>
<br>
<p>Для начала посмотрим основные моменты работы с Иррлихт. Каждый кусок кода самостоятелен, его можно сразу скомпилировать и посмотреть результат.</p>
<pre class="code">/*  Начало работы с Irrlicht Engine 1.4
    Все подробности есть в справке в папке irrlicht-1.4\doc в SDK
    Подключается единственный необходимый хедер */
#include <irrlicht.h>
// irr:: - основное пространство имен, в котором лежит все (!)
using namespace irr;
/*  остальные пространства имен.
    в ядре лежит математика, контейнеры.
    в сцене - все, что связано с 3д сценой.
    в гуй - весь гуй
    в видео - работа с выводом графики
    в ио - файловый ввод-вывод, в том числе XML и работа с файловой системой */
using namespace core;
using namespace scene;
using namespace video;
using namespace io;
using namespace gui;
// поключаем библиотеку
#pragma comment(lib, "Irrlicht.lib")
/*  Очень удобно работать с Ирлихтом вместе с консольным окном,
    т.к. туда кидается большое число полезных логов. */
int main()
{
    /*  Первый шаг - инициализация движка.
        Функция вернет 0, если не удалось.
        Существует два способа инициализации: простой и расширенный (больше параметров).
        Здесь рассматривается простой способ.
        Параметры функции:      
        1 - video::E_DRIVER_TYPE  deviceType    - АПИ для вывода графики.
        Поддерживаются такие: DirectX 9, DirectX 8, OpenGL и два софтварных рендера,
        (The Burning\'s Software Renderer - получше будет)
        2 - const core::dimension2d< s32 > &  windowSize  - размер создаваемого окна.
        3 - u32  bits  - "битность" цветов в полноэкранном режиме, если он выбран.
        4 - bool  fullscreen  - флаг включения полноэкранного режима
        5 - bool  stencilbuffer - флаг, который используется, если необходимо рисовать тени в 3д
        6 - bool  vsync - вертикальная синхронизация (для 3д)
        7 - IEventReceiver *  receiver  - указатель на объектный callback, 
        в который будут скидываться все сообщения ввода     */
    IrrlichtDevice *device = createDevice( video::EDT_SOFTWARE, dimension2d<s32>(640, 480), 16,
                                                false, false, false, 0);
    /*  С помощью этой функции устанавливается заголовок окна.
        Внимание: все строки, которые выводятся на экран, принимаются движком только в Юникоде  */
    device->setWindowCaption(L"Hello World! - Irrlicht Engine Demo");
    /*  Ниже - основные инструменты.
        Видео драйвер отвечает непосредственно за отрисовку на экран
        Менеджер сцены - за расположение и работу с объектами 3д сцены
        Гуй менеджер - за управление элементами гуй */
    IVideoDriver* driver = device->getVideoDriver();
    ISceneManager* smgr = device->getSceneManager();
    IGUIEnvironment* guienv = device->getGUIEnvironment();
    /*  Простой пример создание гуй-контрола. Такие функции возвращают
        указатель на контрол, с помощью которого им можно управлять
        Здесь создается Label с текстовой строкой, 
        в заданном с помощью прямоугольника месте.  */
    IGUIStaticText* text = guienv->addStaticText(L"Hello World! This is the Irrlicht Software renderer!",
        rect<s32>(10,10,260,22), true);
    /* а здесь задается цвет текста. По умолчанию используется стандартный шрифт, но его можно сменить см. IGUIFont   */
    text->setOverrideColor(SColor(128,255,0,0)); 
    /*  Теперь дело за 3д графикой.
        Меш - объект, который хранит информацию о 3д модели. Треугольники, координаты текстур и т.д.
        Нод - объект сцены. Существует большое количество типов нодов, данный нод управляет выводом конкретного меша на экран.
        Один меш может выводиться по-разному разными нодами.     */
    IAnimatedMesh* mesh = smgr->getMesh("../../media/sydney.md2");
    IAnimatedMeshSceneNode* node = smgr->addAnimatedMeshSceneNode( mesh );
    /*  Установка некоторых параметров нода
        1 - Реакция на динамическое освещение (отключена)
        2 - Установка проигрываемой анимации. Для мд2 формата есть свои константы, 
        а вообще она устанавливается по кадрам: 
            node->setFrameLoop(0,310);
            node->setLoopMode(true); - установка зацикленности анимации

            setAnimationEndCallback (IAnimationEndCallBack *callback) - эта функция задает объектный callback, который вызывается после окончания анимации в том случае, если она НЕ зациклена.
        3 - наложение текстуры на меш, первый параметр обычно всегда равен нулю     */
    if (node)
    {
        node->setMaterialFlag(EMF_LIGHTING, false);
        node->setMD2Animation ( scene::EMAT_STAND );
        node->setMaterialTexture( 0, driver->getTexture("../../media/sydney.bmp") );
    }
    /*  Создание простейшей камеры.
        Первый параметр - указание на "родительский" нод, обычно это делают чтобы привязать к нему камеру 
        Второй - позиция камеры
        Третий - точка, куда она смотрит. Эти два параметра могут меняться в процессе, т.к. функция возвращает указатель на камеру  */
    smgr->addCameraSceneNode(0, vector3df(0,30,-40), vector3df(0,5,0));
    //  Основной цикл приложения. Функция run() вернет false, если пользователь закроет окно
    while(device->run())
    {
        /*  Функция, которая подготавливает сцену для отрисовки, вызывается обязательно. Здесь устанавливаются следующие параметры
            1 - очистка заднего фона (третий параметр - цвет очистки)
            2 - чистка z-буфера. Необходимо для 3д графики      */
        driver->beginScene(true, true, SColor(255,100,101,140));
        //  Рисуем сцену и гуй
        smgr->drawAll();
        guienv->drawAll();
        //  конец отрисовки и вывод на экран
        driver->endScene();
    }
    
    // Все объекты иррлихт унаследованы от IReferenceCounted,
    // который считает ссылки и удаляет объект, если на него нет ссылок
    // grab() и drop() - "++" и "--" для ссылок 
    device->drop();
    return 0;
}</pre>
<p><center><img src="'. $site['setting']['base'] .'/img/num/09/01/1.jpg" width="622" height="444" alt="скриншот результат работы"></center></p>
<p>На рисунке показан скриншот результат работы. Позади него консольное окно с логами, очень полезное при отладке.<br>
<br>
В качестве более сложного примера использования библиотеки ниже рассматривается создание просмотрщика уровней Квейка.</p>
<pre class="code">#include <irrlicht.h>
#include <iostream>
using namespace irr;
#pragma comment(lib, "Irrlicht.lib")
int main()
{
    // здесь пользователь может выбрать понравившиеся ему АПИ 
    video::E_DRIVER_TYPE driverType;
    printf("Please select the driver you want for this example:\n"\
        " (a) Direct3D 9.0c\n (b) Direct3D 8.1\n (c) OpenGL 1.5\n"\
        " (d) Software Renderer\n (e) Burning\'s Software Renderer\n"\
        " (f) NullDevice\n (otherKey) exit\n\n");
    char i;
    std::cin >> i;
    switch(i)
    {
        case \'a\': driverType = video::EDT_DIRECT3D9;break;
        case \'b\': driverType = video::EDT_DIRECT3D8;break;
        case \'c\': driverType = video::EDT_OPENGL;   break;
        case \'d\': driverType = video::EDT_SOFTWARE; break;
        case \'e\': driverType = video::EDT_BURNINGSVIDEO;break;
        case \'f\': driverType = video::EDT_NULL;     break;
        default: return 1;
    }
    // инициализируется движок
    IrrlichtDevice *device =
        createDevice(driverType, core::dimension2d<s32>(640, 480));
    // проверка, все ли в порядке
    if (device == 0)
        return 1; 
    video::IVideoDriver* driver = device->getVideoDriver();
    scene::ISceneManager* smgr = device->getSceneManager();
    /* Иррлихт позволяет работать с zip архивами, Данной строчкой он добавляется в "видимость" для ирлихтовского контроллера файловой системы. */
    device->getFileSystem()->addZipFileArchive("../../media/map-20kdm2.pk3");
    // Теперь файлы из архива доступны
    scene::IAnimatedMesh* mesh = smgr->getMesh("20kdm2.bsp");
    scene::ISceneNode* node = 0;
    /* Здесь создается ОктТри нод. Этот нод будет выводиться на экран с оптимизацией по восьмеричному дереву - это необходимо для больших объектов */
    if (mesh)
        node = smgr->addOctTreeSceneNode(mesh->getMesh(0), 0, -1, 128);
    // Изменяется позицию нода, также можно его вращать и масштабировать:
    // SetRotation и SetScale  
    if (node)
        node->setPosition(core::vector3df(-1300,-144,-1249));
    /* Этот вид камеры автоматически подключен к клавиатуре (стрелки) и мышке,
       с помощью которых ей можно управлять, что очень удобно для тестов   */
    smgr->addCameraSceneNodeFPS();
    /* А тут задаются параметры курсора мыши, 
       кроме определения его видимости, можно спрашивать и задавать его расположение */
    device->getCursorControl()->setVisible(false);
    /* В основной цикл, в отличие от прошлого примера, добавлен код отображения
       текущего АПИ и ФПС - количество отрендеренных кадров в секунду   */
    int lastFPS = -1;
    while(device->run())
    if (device->isWindowActive()) // проверка, активно ли окно
    {
        driver->beginScene(true, true, video::SColor(0,200,200,200));
        smgr->drawAll();
        driver->endScene();
        int fps = driver->getFPS();
        if (lastFPS != fps)
        {
            core::stringw str = L"Irrlicht Engine - Quake 3 Map example [";
            str += driver->getName();
            str += "] FPS:";
            str += fps;
            device->setWindowCaption(str.c_str());
            lastFPS = fps;
        }
    }
    device->drop();
    return 0;
}</pre>
<p><center><img src="'. $site['setting']['base'] .'/img/num/09/01/2.jpg" width="648" height="357" alt="скриншот результат работы"></center></p>
<p>Скриншот выглядит уже почти как фрагмент полноценной игры.<br>
Впрочем, с помощью Иррлихта можно создавать не только игры, но и «обычные» приложения, что и демонстрирует следующий пример.</p>
<pre class="code">#include <irrlicht.h>
#include <iostream>
using namespace irr;
using namespace core;
using namespace scene;
using namespace video;
using namespace io;
using namespace gui;
#pragma comment(lib, "Irrlicht.lib")
IrrlichtDevice *device = 0;
s32 cnt = 0;
IGUIListBox* listbox = 0;
class MyEventReceiver : public IEventReceiver
{
public:
    virtual bool OnEvent(const SEvent& event)
    {
        // ресивер может также принимать сообщения от собственного гуи
        if (event.EventType == EET_GUI_EVENT)
        {
            // каждому элементу можно и нужно задать свое числовое ид
            // здесь мы получаем ид гуй, который среагировал на действия пользователя
            s32 id = event.GUIEvent.Caller->getID();
            IGUIEnvironment* env = device->getGUIEnvironment();
            // можно определить тип события, которое произошло с контролом
            switch(event.GUIEvent.EventType)
            {
            // например был прокручен скроллбар
            case EGET_SCROLL_BAR_CHANGED:
                if (id == 104)
                {
                    // выясняется позиция бегунка
                    s32 pos = ((IGUIScrollBar*)event.GUIEvent.Caller)->getPos();
                    // и изменяется альфа канал у всех элементов активного скина
                    // скин отвечает за многие параметры (вообще оформление)
                    // навешенных на него гуи. Можно создавать разные скины   
                    // и активизировать по мере надобности.
                    for (u32 i=0; i<EGDC_COUNT ; ++i)
                    {
                        SColor col = env->getSkin()->getColor((EGUI_DEFAULT_COLOR)i);
                        col.setAlpha(pos);
                        env->getSkin()->setColor((EGUI_DEFAULT_COLOR)i, col);
                    }
                }
                break;
            // клик по кнопке
            case EGET_BUTTON_CLICKED:
                if (id == 101)
                {
                   // таким способом можно заставить device->run() вернуть false
                    device->closeDevice();
                    return true;
                }

                if (id == 102)
                {
                    // Добавить строку в листбокс
                    listbox->addItem(L"Window created");
                    cnt += 30;
                    if (cnt > 200) 
                        cnt = 0;
                    // создается "дочернее" (не Windows) окошко
                    IGUIWindow* window = env->addWindow(
                        rect<s32>(100 + cnt, 100 + cnt, 300 + cnt, 200 + cnt), 
                        false, // модальность
                        L"Test window"); // заголовок
                    // Label
                    env->addStaticText(L"Please close me",  
                        rect<s32>(35,35,140,50),
                        true, // border
                        false, // wordwrap
                        window);

                    return true;
                }

                if (id == 103)
                {
                    listbox->addItem(L"File open");
                    // Можно пользоваться стандартными диалогами открытия файла
                    env->addFileOpenDialog(L"Please choose a file.");
                    return true;
                }

                break;
            default:
                break;
            }
        }

        return false;
    }
};
int main()
{
    video::E_DRIVER_TYPE driverType;
    printf("Please select the driver you want for this example:\n"\
        " (a) Direct3D 9.0c\n (b) Direct3D 8.1\n (c) OpenGL 1.5\n"\
        " (d) Software Renderer\n (e) Burning\'s Software Renderer\n"\
        " (f) NullDevice\n (otherKey) exit\n\n");
    char i;
    std::cin >> i;
    switch(i)
    {
        case \'a\': driverType = video::EDT_DIRECT3D9;break;
        case \'b\': driverType = video::EDT_DIRECT3D8;break;
        case \'c\': driverType = video::EDT_OPENGL;   break;
        case \'d\': driverType = video::EDT_SOFTWARE; break;
        case \'e\': driverType = video::EDT_BURNINGSVIDEO;break;
        case \'f\': driverType = video::EDT_NULL;     break;
        default: return 1;
    }   
    device = createDevice(driverType, core::dimension2d<s32>(640, 480));
    if (device == 0)
        return 1; 
    MyEventReceiver receiver;
    device->setEventReceiver(&receiver);
    device->setWindowCaption(L"Irrlicht Engine - User Interface Demo");
    video::IVideoDriver* driver = device->getVideoDriver();
    IGUIEnvironment* env = device->getGUIEnvironment();
    // а здесь загружается новый шрифт, он должен быть создан с помощью специального инструмента 
    // FontTool из SDK, и состоит как минимум из xml и одной - нескольких текстур
    IGUISkin* skin = env->getSkin();
    IGUIFont* font = env->getFont("../../media/fonthaettenschweiler.bmp");
    if (font)
        skin->setFont(font);

    skin->setFont(env->getBuiltInFont(), EGDF_TOOLTIP);
    // Здесь создаются кнопки. Обязательно нужно задавать для кнопок id, чтобы потом ловить их в ресивере
    // кнопки могут быть двух видов Pressed и не Pressed, 
    // не Pressed обладает обычным поведением, как у виндовской кнопки
    // Pressed напоминает checkbox, после нажатия она остается в таком состоянии до повторного клика.
    // Для кнопок можно устанавливать картинки (2 шт. - нажатое и отжатое состояние)
    env->addButton(rect<s32>(10,240,110,240 + 32), 0, 101, L"Quit", L"Exits Program");
    env->addButton(rect<s32>(10,280,110,280 + 32), 0, 102, L"New Window", L"Launches a new Window");
    env->addButton(rect<s32>(10,320,110,320 + 32), 0, 103, L"File Open", L"Opens a file");
    env->addStaticText(L"Transparent Control:", rect<s32>(150,20,350,40), true);
    // создание скроллбара и установка максимального значения
    IGUIScrollBar* scrollbar = env->addScrollBar(true, rect<s32>(150, 45, 350, 60), 0, 104);
    scrollbar->setMax(255);
    // управление скроллбаром
    scrollbar->setPos(env->getSkin()->getColor(EGDC_WINDOW).getAlpha());
    env->addStaticText(L"Logging ListBox:", rect<s32>(50,110,250,130), true);
    listbox = env->addListBox(rect<s32>(50, 140, 250, 210));
    // есть, конечно, и editbox
    env->addEditBox(L"Editable Text", rect<s32>(350, 80, 550, 100));
    env->addImage(driver->getTexture("../../media/irrlichtlogo2.png"),position2d<int>(10,10));
    while(device->run() && driver)
    if (device->isWindowActive())
    {
        driver->beginScene(true, true, SColor(0,200,200,200));
        env->drawAll();
        driver->endScene();
    }
    device->drop();
    return 0;
}</pre>
<p><center><img src="'. $site['setting']['base'] .'/img/num/09/01/3.jpg" width="645" height="400" alt="скриншот результат работы"></center></p>
<p><i>Авторские права: весь код, использованный в данной статье, взят из Irrlicht SDK  и принадлежит его создателям. Автор только изменил комментарии в коде.</i></p>';
	break;
//-------------------------------------------------------------------------------------------------------

case '1009/visual_c_vb_lugin.html':
	$site['page']['title'] .= ' - Visual C++ 6/Visual Basic 6: Работа с плагинами';
	$site['page']['keywords'] .= ', Visual C Visual Basic Работа плагинами, Visual Basic плагин';
	$site['page']['body'] .= '<h1>Visual C++ 6/Visual Basic 6: Работа с плагинами</h1>
<b>Автор:</b> <noindex><a href="http://forum.sources.ru/index.php?showuser=23565" rel="nofollow" target="_blank"><i>B.V.</i></a></noindex>
<h4>Введение</h3>
<p><b>Плагин</b> – подключаемый модуль, который дополняет, расширяет функциональность программы без изменения её исходного кода. Например, придает программе новый внешний вид, увеличивает количество поддерживаемых форматов файлов, добавляет новые инструменты для работы с графикой или текстом... Ниже рассказывается о разработке плагинов в проектах на Visual C++ 6/Visual Basic 6. Предполагается, что читатель знаком с языками программирования С++ и/или Visual Basic, средой разработки Visual Studio 6 и WinAPI.</p>
<p>Как правило, плагины поставляются в виде Native DLL – обычной библиотеки, экспортирующей определенный набор функций. Список экспортируемых функций содержится в <b>таблице экспорта</b> (Export table), в которой названию функции соответствует её<b> точка входа</b> (Entry point) в библиотеке. Кроме того, каждой функции присваивается <b>номер</b> (Ordinal), по которому её можно вызвать точно так же, как и по имени. Для получения точки входа функции из таблицы экспорта используется функция GetProcAddress. VB6 не поддерживает компиляцию таких библиотек. Способы обхода подобных запретов существуют, но они требует отдельного разговора, поэтому пока не остается ничего, кроме использования разрешенных VB типов библиотек: ActiveX DLL. ActiveX DLL по своей сути тоже является Native DLL, но с COM-объектами. В таких библиотеках функции располагаются в <b>COM-классах</b> в виде методов и свойств. Доступ к ним осуществляется посредством <b>COM-интерфейсов</b> <i>IUnknown</i> и <i>IDispatch</i>. VB6 берет на себя работу с этими интерфейсами, хоть и в ущерб функциональности, но в VC++6 придется работать с ними явно.</p>
<h3>COM-интерфейсы и работа с ними VB</h3>
<p><i>Этот раздел может смело пропустить тот читатель, который собирается разрабатывать плагины только на VC++ или просто не желает вдаваться в подробности COM. Разработчику на VB вовсе не обязательно досконально знать механизм работы COM, достаточно иметь о нем общее представление.</i></p>
<ol>
	<li>При подключении COM-объекта VB вызывает IUnknown посредством CoCreateInstance с IID_IUnknown.</li>
	<li>Метод CoCreateInstance, в свою очередь, вызывает CoGetClassObject с IID_IClassFactory.  IClassFactory  – это обязательный интерфейс описания COM-объектов.</li>
	<li>Вызвав затем pIClassFactory->CreateInstance с IID_IUnknown, VB получает указатель на интерфейс IUnknown (pIUnknown).</li>
	<li>Далее VB вызывает pIUnknown->QueryInterface с IID_IDispatch для получения указателя на IDispatch (pIDispatch).</li>
</ol>
<p>Если pIDispatch будет равен нулю, VB откажется работать с таким COM-объектом. Впрочем, интерфейс IDispatch необязателен, его задача обеспечить работу OLE Automation контроллера (в качестве которого выступает, например, сам VB) с OLE Automation объектом. Работать с COM-объектом без IDispatch просто:</p>
<ul>
	<li>в начале каждого интерфейса (класса) COM-объекта компилятор записывает 4-байтный указатель virtual table pointer (или сокращенно vPointer) на массив 4-байтных указателей virtual method table (или сокращенно vTable);</li>
	<li>в vTable хранятся указатели на методы унаследованных интерфейсов2, а также методы и свойства текущего интерфейса. Первые три указателя каждой vTable всегда указывают на методы IUnknown. IUnknown обязателен для любого интерфейса COM-объекта, так как он позволяет:
		<ol>
			<li>получать указатели на прочие интерфейсы COM-объекта,</li>
			<li>вести учет количества ссылок на интерфейс COM-объекта</li>
			<li>и освобождать интерфейс COM-объекта.</li>
		</ol>
	Указатели в vTable располагаются в том же порядке, что и методы/свойства в коде интерфейса. Таким образом, зная расположение методов/свойств (VC++ об этом знает из *.h-файлов, в которых определены интерфейсы), можно получить требуемый указатель.</li>
</ul>
<p>Ниже приводится наглядный листинг, демонстрирующий формирование vTable у интерфейса COM-объекта:</p>
<pre class="code">//Создается абстрактный класс (интерфейс) для класса A...

//Определяется IID_IA для QueryInterface
extern "C" const GUID __declspec(selectany) IID_IA = {%IID_IA_GUID%};

//Этот класс должен иметь свой GUID, но не должен обладать vTable
interface struct __declspec(uuid("%IA_GUID%")) __declspec(novtable) IA : public IUnknown //Наследуется интерфейс IUnknown
{
public:
    //Объявляются методы интерфейса (т.н. \'pure virtual functions\')
    virtual void __stdcall func1() = 0;
    virtual void __stdcall func2() = 0;
    virtual void __stdcall func3() = 0;
};

//Класс для реализации функций интерфейса
class A : public IA //Наследуется интерфейс IA
{
public:
    //Реализуется IUnknown
    virtual HRESULT __stdcall QueryInterface(REFIID riid, LPVOID FAR* ppvObj){/* реализация */};
    virtual ULONG __stdcall AddRef(){/* реализация */};
    virtual ULONG __stdcall Release(){/* реализация */};
    //Реализация IA
    void func0(){/* реализация */} //Не виртуальная функция, она не будет включена в vTable
    virtual void __stdcall func1(){/* реализация */};
    virtual void __stdcall func2(){/* реализация */};
    virtual void __stdcall func3(){/* реализация */};
};

//Создаётся экземпляр класса A...
A * a = new A;</pre>
<pre class="output">Образ памяти созданного экземпляра a: 
+0: указатель на virtual method table класса A (vPointer)
virtual method table класса A:
    +0: A::QueryInterface(...)
    +4: A::AddRef()
    +8: A::Release()
    +12: A::func1()
    +16: A::func2()
    +20: A::func3()
    +24: A::~A()</pre>
<p>Если расположение методов/свойств неизвестно (нет *.h-файла), может помочь декомпиляция TypeLibrary. Например, с помощью инструмента OLE View, входящего в дистрибутив Visual Studio 6 (Microsoft Visual Studio\Common\Tools\OLEVIEW.EXE). Для этого необходимо запустить OLE View, выбрать \'File->View TypeLib…\' и выбрать нужный файл. В описании нужного интерфейса будут показаны прототипы методов/свойств в нужном порядке. При этом необходимо помнить о методах IUnknown и IDispatch, если последний присутствует:</p>
<pre class="code">interface _A : IUnknown {
    [id(0x00000001)]
    void func1();
    [id(0x00000002)]
    void func2();
    [id(0x00000003)]
    void func3();
};</pre>
<p>Этого достаточно, чтобы определить интерфейс в каком-нибудь *.h-файле, автоматически преобразовав ODL/IDL файл в *.h-файл с помощью MKTYPLIB.EXE или директивы #import. Если же нужен только один из методов, то после того, как OLE View показал его порядковый номер метода и прототип, ничто не мешает его вызвать:</p>
<pre class="code">#define METHOD_NUM 4 //Указывается номер вызываемого метода (func2). 3 метода IUnknown + 1 метод IA

void Foo()
{
    __asm
    {
        mov ebx, [a]; //Сохранение адреса класса (COM-интерфейса, если угодно)
        mov esi, [ebx]; //Получение в esi vPointer
        push ebx; //Передается this
        call [esi + METHOD_NUM * 4]; //Вызывается метод...
    }
}</pre>
<p>Если VB получит указатель на IDispatch, то вызов метода/свойства будет осуществлен через pIDispatch->Invoke, а перед этим будет вызван pIDispatch->GetIDsOfNames с именем вызываемой функции для получения указателя на эту функцию dispidMember.<br>
Прототип pIDispatch->Invoke выглядит следующим образом:</p>
<pre class="code">HRESULT Invoke(DISPID dispidMember, REFIID riid, LCID lcid, unsigned short wFlags, DISPPARAMS FAR* pdispparams, VARIANT FAR* pvarResult, EXCEPINFO FAR* pexcepinfo, unsigned int FAR* puArgErr);</pre>
<p>Здесь:<br>
<br>
riid -  зарезервированный на будущее аргумент, он всегда должен быть равен IID_NULL.<br>
lcid - задает контекст локали, в который будут интерпретироваться аргументы. Если приложение не поддерживает множественные национальные языки, этот параметр можно проигнорировать.<br>
wFlags - определяет режим вызова для Invoke и может принимать следующие значения:<br>
DISPATCH_METHOD - член реализован как метод.<br>
DISPATCH_PROPERTYGET - член должен вызываться как свойство (или член данных) для получения значения<br>
DISPATCH_PROPERTYPUT - член должен изменить свое значение как свойство (или член данных).<br>
DISPATCH_PROPERTYPUTREF - член должен изменить свое значение как свойство (или член данных) через присвоение ссылки, а не значения, как в предыдущем случае.<br>
pdispparams - указатель на структуру DISPPARAMS, содержащую массив аргументов, массив argument dispatch IDs для именованных аргументов и числа, определяющие количество элементов в массивах.<br>
pvarResult - указатель на то место, куда будет записан возвращенный результат. Если вызывается присвоение значения свойству или процедура, не возвращающая значения, этот указатель должен быть равен нулю.<br>
pexcepinfo - указатель на структуру с описанием исключения. Структура будет заполнена только в том случае, если SCODE значение будет равно DISP_E_EXCEPTION.<br>
puArgErr - возвращает индекс в массиве аргументов rgvarg первого элемента, вызвавшего ошибку. Аргументы в pdispparams->rgvarg запоминаются в обратном порядке, так что первый аргумент будет иметь самый старший индекс в массиве аргументов. Этот параметр возвращается только в том случае, если SCODE будет равен DISP_E_TYPEMISMATCH или DISP_E_PARAMNOTFOUND.<br>
<br>
MSDN предоставляет перечень значений, которые может вернуть Invoke в SCODE. Читатель может ознакомиться с ними самостоятельно, сейчас следует учитывать только то, что в случае успеха SCODE должен быть равен S_OK, а все остальные значения свидетельствуют об ошибке вызова.<br>
<br>
Реализация этого метода интерфейса IDispatch обычно сводится к вызову DispInvoke:</p>
<pre class="code">class FAR CMyInterface : public IMyInterface
{
public:

//...

//Декларация метода IDispatch в классе
//virtual HRESULT __stdcall
STDMETHOD(Invoke)(DISPID dispidMember, 
                    REFIID riid, 
                    //... 
                    EXCEPINFO FAR* pexcepinfo, 
                    UINT FAR* puArgErr); 

//...

};

//Реализация метода. Вместо DispInvoke можно использовать класс ITypeInfo,
//или, в крайнем случае, CreateStdDispatch
STDMETHODIMP //HRESULT __export __stdcall
CMyInterface::Invoke(DISPID dispidMember, 
                  REFIID riid, 
                  //...
                  EXCEPINFO FAR* pexcepinfo, 
                  UINT FAR* puArgErr) 
{

    //...

    return DispInvoke(this, m_ptinfo, dispidMember, wFlags, pdispparams, 
        pvarResult, pexcepinfo, puArgErr); 
}</pre>
<p>Будем считать, что общее представление о работе VB с интерфейсами и об интерфейсах в целом получено.</p>
<h3>Организация системы плагинов</h3>
<p><b>Система плагинов</b> - это своего рода план, согласно которому будут взаимодействовать плагины и программа. К системе плагинов стоит отнестись серьезно, так как от способа её реализации сейчас зависит будущее плагинов вашего проекта. Предусмотреть все, конечно, невозможно, но вполне реально свести проблемы обратной совместимости к минимуму. Например, не следует передавать в ключевые функции плагина набор аргументов, лучше передать указатель на структуру с аргументами, что даст возможность расширения количества аргументов с сохранением обратной совместимости. 
Перед тем, как приступить к составлению системы плагинов, нужно определиться, какую задачу (или задачи) должен реализовывать каждый плагин и что ему нужно для реализации этой задачи (задач). Рассмотрим конкретный пример:</p>
<p>Пусть имеется текстовый редактор TextPad, представляющий собой окно с полем EDIT и умеющий открывать/сохранять файлы в формате Plain Text. Возникла потребность расширить функциональность TextPad, допустим, возможностями поиска текста и отображения статистики документа (количества символов, строк, слов...). Плагинам для выполнения этих задач потребуется возможность работы с полем EDIT. Значит, манипулятор этого поля нужно передать плагинам. Кроме того, окнам плагинов совсем не помешает возможность взаимодействия с основным окном программы. Значит, кроме манипулятора окна EDIT, полезно передать и манипулятор основного окна программы. Предоставить пользователю возможность работы с плагинами проще всего посредством пунктов меню. Но чтобы определиться с заголовками этих пунктов, потребуется возможность получения полного название каждого плагина. Полученная в итоге схема системы плагинов для TextPad показана на рис. 1.</p>
<p><center><img src="'. $site['setting']['base'] .'/img/num/09/02/1.png" width="400" height="300" alt="Схема системы плагинов для TextPad"><br>
Рис. 1 – Схема системы плагинов для TextPad</center></p>
<p>При запуске программы, или в любой другой удобный момент времени, можно загрузить плагин и получить его имя, которое затем использовать для добавления пункта в меню плагинов. Как только пользователь выбрал  некоторый пункт меню, соответствующему плагину передается манипулятор основного окна и манипулятор поля EDIT, фактически активируя выполнение плагина.<br>
Ниже рассмотрен процесс обмена данными (передача и получение) между программой и плагинами.</p>
<h3>Интерфейс плагинов</h3>
<p>Интерфейс плагинов – это механизм взаимодействия плагинов с основной программой, который может представлять собой набор методов COM-класса, набор сообщений для окна программы, общий контейнер данных (FileMapping или Named Pipes) и т.д., а также комбинацию всего перечисленного.<br>
Выбор подходящего интерфейса – дело вкуса. Кому-то нравится набор функций под каждое действие, кто-то, как автор, предпочитает компактность, кто-то комбинирует одно с другим. Система плагинов в примере с TextPad достаточно проста, поэтому нет нужды создавать сложный интерфейс из нескольких функций и/или ряда сообщений. Остановимся на одной функции Plugin Main с единственным аргументом - указателем на общую для плагина и TextPad структуру TPPLUGIN [TextPad Plugin]. Она состоит из</p>
<ol>
	<li>манипулятора основного окна;</li>
	<li>манипулятора окна EDIT;</li>
	<li>строки для имени плагина.</li>
</ol>
<p>Для различения режимов вызова основной функции можно, конечно, проверять значение манипуляторов, и, если оно будет равно нулю, считать вызов запросом имени. Но такой способ не является практичным и наглядным. Лучше добавить флаги, определяющие режим вызова основной функции плагина. Не помешает также флаг, сигнализирующий о завершении работы плагина, например, когда плагин отображает немодальное диалоговое окно через CreateDialog[Param] и выходит из основной функции:</p>
<pre class="code">typedef struct tagTPPLUGIN
{
    DWORD dwFlags;          //Флаги, определяющие режим вызова основной функции плагина и т.п.
    LPSTR lpDisplayName;        //Имя плагина, отображающееся в меню TextPad
    HWND hMainWnd;          //Манипулятор основного окна
    HWND hEditWnd;          //Манипулятор поля EDIT
} TPPLUGIN, * LPTPPLUGIN;

//Флаги:
#define TPPF_GETDATA    0x20        //Функция вызывается для получения каких-либо данных, например, lpDisplayName.
#define TPPF_ACTION 0x40        //Функция вызывается для выполнения задачи плагина

#define TPPF_ACTIVE 0x400       //Флаг активности плагина. TextPad не будет выгружать плагин до тех пор, пока
//этот флаг установлен. За снятие флага отвечает плагин.

//Основная функция плагина TextPad
//      pTPPlug: указатель на структуру TPPLUGIN
//      Возвращаемое значение: 0 в случае успеха, код ошибки иначе
extern "C" DWORD WINAPI TextPadPluginMain(LPTPPLUGIN pTPPlug)
{
    //Вызов на выполнение
    if ((pTPPlug->dwFlags & TPPF_ACTION) == TPPF_ACTION)
    {
        //Работа
        pTPPlug->dwFlags = (pTPPlug->dwFlags ^ TPPF_ACTIVE);
        return 0;
    }
    else //Вызов для получения информации
    {
        pTPPlug->lpDisplayName = "Plugin Name";
        pTPPlug->dwFlags = (pTPPlug->dwFlags ^ TPPF_ACTIVE);
        return 0;
    }
}</pre>
<p>Но для VB этот способ в общем случае неприемлем. Дело в том, что передача User Defined Type (UDT) по ссылке в метод класса возможна только в том случае, если переменная была объявлена как UDT, определенный в данном классе. То есть, при попытке вызова метода объекта, полученного от CreateObject (позднее связывание, используемое, в том числе и для организации работы плагинов) компилятор выведет сообщение следующего содержания:</p>
<pre class="output">Compile error: 
Only user-defined types defined in public object modules can be coerced to or from a variant or passed to late-bound functions</pre>
<p>А при раннем связывании:</p>
<pre class="output">Compile error:
ByRef argument type mismatch</pre>
<p>Можно передать указатель на UDT как ByVal VarPtr(UDT) As Long, но работать со структурой в плагине станет, мягко говоря, неудобно. Придется обходиться методами и свойствами:</p>
<pre class="code">Option ExplicitPublic Function PluginMain() As Long
    \'Работа
    \'По завершению необходимо позаботиться о том, что бы свойство IsActive возвращало False
    PluginMain = 0
End FunctionPublic Property Get DisplayName() As String
    \'Здесь возвращается имя плагина
    DisplayName = "Plugin Name"
End PropertyPublic Property Let MainWnd(ByVal hValue As Long)
    \'...
End PropertyPublic Property Let EditWnd(ByVal hValue As Long)
    \'...
End PropertyPublic Property Get IsActive() As Boolean
    \'Здесь возвращается флаг активности плагина. TextPad не будет выгружать плагин до тех пор,
    \'пока этот флаг установлен.
End PropertyPublic Property Let IsActive(ByVal bValue As Boolean)
    \'Это свойство TextPad устанавливает в True перед вызовом PluginMain
End Property</pre>
<p>Впрочем, можно было и не создавать собственные плагины на VB, а использовать плагины VC++ из проекта на VB точно так же, как и в проекте на VC++. Обратное тоже верно. Но тогда была бы нарушена чистота эксперимента.</p>
<h3>Использование плагинов</h3>
<p>Система плагинов составлена, интерфейс плагинов создан, осталось только всем этим воспользоваться. Так как VB вынуждает использовать COM, алгоритмы работы с плагинами на VC++ и VB будут немного отличаться (листинги, приведенные ниже, сокращены, полный код см. в примерах к статье).</p>
<p><b>Сначала рассмотрим VC++</b>. Каждый плагин должен иметь свою собственную копию структуры TPPLUGIN, в которой будет храниться его описание, флаги и еще один член, необходимый для работы с загруженным плагином - манипулятор плагина. Так как этот член полезен только в TextPad, он не был указан в структуре, определенной выше. 
Для работы с плагинами в программе потребуется создать массив указателей на TPPLUGIN достаточной размерности, например, на 500 плагинов. По мере загрузки новых плагинов в массив будут записываться и инициализироваться указатели на новые структуры:</p>
<pre class="code">#define MAX_PLUGINS     500

typedef struct tagTPPLUGIN
{
    DWORD dwFlags;
    LPSTR lpDisplayName;
    HWND hMainWnd;
    HWND hEditWnd;
    //--------------------
    HMODULE hPlugin;
    //--------------------
} TPPLUGIN, * LPTPPLUGIN;

//...

LPTPPLUGIN pTPP[MAX_PLUGINS];

void InitTPPArr(DWORD dwIndex)
{
    pTPP[dwIndex] = new TPPLUGIN;
    pTPP[dwIndex]->dwFlags = 0;
    pTPP[dwIndex]->lpDisplayName = "None";
    pTPP[dwIndex]->hMainWnd = 0;
    pTPP[dwIndex]->hEditWnd = 0;
    //--------------------
    pTPP[dwIndex]->hPlugin = 0;
    //--------------------
}</pre>
<p>Непосредственно для реализации функции загрузки плагинов (LoadPlugins) стоит обратить внимание на функции FindFirstFile/FindNextFile, LoadLibrary и GetProcAddress. Первые две потребуются для получения списка плагинов, вторая для загрузки плагинов в память, последняя для получения адреса основной функции плагина TextPadPluginMain. Также потребуется функция AppendMenu, так как система плагинов предусматривает отображение плагинов в пунктах меню. Для AppendMenu нужен манипулятор меню плагинов, и наиболее наглядным способом будет передача манипулятора в качестве аргумента функции LoadPlugins:</p>
<pre class="code">#define ID_PLGBASE      110
#define ID_PLGUBOUND        1110

BOOL LoadPlugins(HMENU hPlugMenu)
{

    //...
    
    //Начинается поиск файлов в директории плагинов по маске \'*.dll\'
    hSearch = FindFirstFile(lpFindMask, &WFD);
    if (hSearch != INVALID_HANDLE_VALUE)
    {
        bNext = TRUE;
        while (bNext && dwCnt != MAX_PLUGINS)
        {
            if (strcmp(WFD.cFileName, ".") != 0 && strcmp(WFD.cFileName, "..") != 0)
            {
                InitTPPArr(dwCnt); //Инициализируется новую структуру TPPLUGIN
                
                //...

                //Манипулятор плагина запоминается в структуре
                pTPP[dwCnt]->hPlugin = LoadLibrary(lpPlug);
                if (!pTPP[dwCnt]->hPlugin)
                {
                    FindClose(hSearch);
                    return FALSE;
                }
                //Адрес основной функции плагина
                (FARPROC &)TextPadPluginMain = GetProcAddress(pTPP[dwCnt]->hPlugin, "TextPadPluginMain");
                //Флаги для получения информации
                pTPP[dwCnt]->dwFlags = TPPF_GETDATA | TPPF_ACTIVE;
                if (TextPadPluginMain(pTPP[dwCnt]) != 0)
                {
                    //Ошибка плагина
                }
                //Добавление нового пункта в меню. Его ID представляет собой ID_PLGBASE + порядковый
                //индекс плагина. Это поможет при активации плагина из ID меню получить исходный
                //порядковый индекс.
                if ((ID_PLGBASE + dwCnt) < ID_PLGUBOUND)
                    AppendMenu(hPlugMenu, MF_STRING, ID_PLGBASE + dwCnt, pTPP[dwCnt]->lpDisplayName);
            }
            bNext = FindNextFile(hSearch, &WFD);
            dwCnt++;
        }
        FindClose(hSearch);
        return TRUE;
    }
    else
    {
        return FALSE;
    }
}</pre>
<p>В функции загрузки можно предусмотреть дополнительную обработку ошибок. Например, можно проверять манипулятор плагина и адрес функции TextPadPluginMain, так как нельзя исключать возможность повреждения плагина или плагина, который не является Win32 DLL. Можно не экспортировать функции с подобным именем, можно предусматривать пропуск цикла, если основная функция вернула код ошибки.<br>
<br>
Для активации плагина нужна информация о том, какой именно плагин следует активировать, а также манипуляторы основного окна и окна EDIT. Все это можно передать функции ActivatePlugin в качестве аргументов, но лучше сделать две глобальные переменные для хранения манипуляторов окон, а в качестве аргумента передавать только индекс активируемого плагина. Дело в том, что манипуляторы от вызова к вызову меняться не будут, и их можно определить единожды, например, сразу после создания соответствующих окон:</p>
<pre class="code">HWND hPDMainWindow;
HWND hPDEditWindow;

BOOL ActivatePlugin(USHORT uPlugID)
{

    //...

    (FARPROC &)TextPadPluginMain = GetProcAddress(pTPP[uPlugID - ID_PLGBASE]->hPlugin, 
        "TextPadPluginMain");
    pTPP[uPlugID - ID_PLGBASE]->hMainWnd = hPDMainWindow;
    pTPP[uPlugID - ID_PLGBASE]->hEditWnd = hPDEditWindow;
    //Флаги для активации плагина
    pTPP[uPlugID - ID_PLGBASE]->dwFlags = TPPF_ACTION | TPPF_ACTIVE;
    if (TextPadPluginMain(pTPP[uPlugID - ID_PLGBASE]) != 0)
    {
        //Ошибка плагина
    }
    return TRUE;
}</pre>
<p>Для выгрузки плагинов поребуются две функции: FreeLibrary и RemoveMenu. Алгоритм довольно прост, нужно пройти в цикле по всем элементам массива плагинов и методично выгрузить один плагин за другим, одновременно удаляя соответствующие пункты меню:</p>
<pre class="code">BOOL UnloadPlugins(HMENU hPlugMenu)
{
    for (int i = 0; i < MAX_PLUGINS; i++)
    {
        if (pTPP[i])
        {
            //Надо проверить, не продолжает ли плагин свою работу. Если продолжает – отменить
            //дальнейшую выгрузку, так как выгрузка работающего плагина чревата падением этого плагина,
            //а вместе с ним и всей программы. 
            if ((pTPP[i]->dwFlags & TPPF_ACTIVE) == TPPF_ACTIVE) return FALSE;
            FreeLibrary(pTPP[i]->hPlugin); //Выгрузка плагин
            RemoveMenu(hPlugMenu, ID_PLGBASE + i, MF_BYCOMMAND); //Удаление соответствующего пункта меню
        }
    }
    return TRUE;
}</pre>
<p>Вместо проверки на TPPF_ACTIVE можно было бы предусмотреть в интерфейсе функцию ClosePlugin и оставить продолжение работы на совести плагина. Кстати, в этом случае вовсе не обязательно экспортировать еще одну функцию, достаточно предусмотреть в структуре TPPLUGIN новый член pClosePlugin, хранящий указатель на данную функцию в плагине.<br>
<br>
Рассмотренные выше функции полностью поддерживают работу с плагинами на VC. Они объединены в классе CPlugins (см. файл TextPad.h). В примерах к статье можно найти плагин FindText, обеспечивающий поддержку поиска текста в поле EDIT, там же есть пустой тестовый плагин, с которого можно начать разработку своего собственного плагина для TextPad на VC++.</p>
<br><br>
<p><b>Теперь рассмотрим VB</b>. Алгоритм будет несколько отличаться, на VB предстоит целиком и полностью работать с COM-объектами, о методе загрузки плагинов на VC++ можно забыть. Вместо массива указателей на TPPLUGIN будет использоваться массив ссылок на COM-объекты – плагины. Размерность пусть останется той же – 500. Массив будет заполняться непосредственно в функции загрузки плагинов ссылками, возвращаемыми VB-функцией CreateObject. Эта функция вызывает CLSIDFromProgID для конвертации ProgID в CLSID, затем CoCreateInstance с IID_IUnknown и pIUnknown->QueryInterface с IID_IDispatch. Поиск файлов будет осуществляться с помощью встроенной VB-функции Dir. Но LoadLibrary/GetProcAddress/FreeLibrary, а также CallWindowProc все равно потребуются, так как у ActiveX библиотек есть один весьма неприятный недостаток: для работы их необходимо зарегистрировать, пусть и единожды. Регистрация представляет собой запись в HKEY_CLASSES_ROOT\ таких данных, как CLSID всех определенных в библиотеке COM-объектов, их ProgID, ID интерфейсов и т.д. Эту непростую задачу решает функция DLLRegisterServer, которую должна экспортировать любая библиотека, претендующая на поддержку OLE Automation. VB создает эту функцию автоматически, в VC пришлось бы реализовывать её самостоятельно.<br> 
Ниже показана регистрация плагинов с помощью вызова экспортируемой ими функции DLLRegisterServer:</p>
<pre class="code">Private Function RegisterLib(ByVal strFileName As String) As Boolean
    On Error Resume Next    \'...

    hLib = LoadLibrary(strFileName)
    If hLib = 0 Then Exit Function
    hProc = GetProcAddress(hLib, "DllRegisterServer")
    If hProc = 0 Then GoTo StopRegister
    \'Вызов DLLRegisterServer для регистрации плагина в системном реестре
    \'Нужно обойти невозможность в VB вызывать функции по указателю:
    If CallWindowProc(hProc, 0, ByVal 0&, ByVal 0&, ByVal 0&) _
        <> 0 Then GoTo StopRegister
    RegisterLib = True
StopRegister:
    Call FreeLibrary(hLib)
End Function</pre>
<p>Регистрацию стоит проводить только в том случае, если плагин еще не зарегистрирован, или если его регистрация повреждена. Проще всего это сделать при обработке VB-ошибки 429, которую генерирует CreateObject в том случае, если попытка создать объект с заданным ProgID была неудачной:</p>
<pre class="code">Private Const MAX_PLUGINS As Long = 500Private hTPPlugArr(MAX_PLUGINS) As ObjectPublic Function LoadPlugins() As Boolean
    On Error GoTo Error    \'...

    strFileList = Dir(strFolder & strPattern, vbNormal)
    Do While Not strFileList = vbNullString
        lFilesCnt = lFilesCnt + 1
        \'Создание объекта из найденной ActiveX DLL
        Set hTPPlugArr(lFilesCnt) = CreateObject(GetTitle(strFileList) & ".clsMain")
        \'Создание пункта меню для плагина...
        If frmMain.mnuPlugin.UBound < lFilesCnt Then
            Load frmMain.mnuPlugin(lFilesCnt)
            With frmMain.mnuPlugin(lFilesCnt)
                .Visible = True
                .Caption = hTPPlugArr(lFilesCnt).DisplayName
            End With
        Else
            frmMain.mnuPlugin(lFilesCnt).Caption = hTPPlugArr(lFilesCnt).DisplayName
        End If
        strFileList = Dir
        DoEvents
    Loop
    LoadPlugins = True
Error:
    If Err.Number <> 0 Then
        Select Case Err.Number
            Case 429 \'ActiveX компоненту не удалось создать объект. Попытка регистрации
                If RegisterLib(strFolder & strFileList) Then
                    Err.Clear
                    Resume
                End If
            Case Else
                LoadPlugins = False
                Exit Function
        End Select
    End If
End Function</pre>
<p>Функция ActivatePlugin получает индекс плагина в массиве, инициализирует его свойства и вызываем PluginMain:</p>
<pre class="code">Public Function ActivatePlugin(ByVal lPlugID As Long) As Boolean    \'...

    hTPPlugArr(lPlugID).MainWnd = hPDMainWindow
    hTPPlugArr(lPlugID).EditWnd = hPDEditWindow
    hTPPlugArr(lPlugID).IsActive = True
    If hTPPlugArr(lPlugID).PluginMain <> 0 Then
        \'Ошибка плагина
    End If
    ActivatePlugin = True
End Function</pre>
<p>Функция выгрузки плагинов похожа на рассмотренную для VC++. Осуществляется  проход по массиву в цикле и методично удаляются ссылки на объекты после проверки их на активность:</p>
<pre class="code">Public Function UnloadPlugins() As Boolean
    Dim i As Long
    For i = 0 To UBound(hTPPlugArr)
        If Not hTPPlugArr(i) Is Nothing Then
            If hTPPlugArr(i).IsActive Then
                UnloadPlugins = False
                Exit Function
            End If
            \'Удаление ссылки на класс 
            Set hTPPlugArr(i) = Nothing
            \'Если меню основное – изменяется заголовок, его копии удаляются
            If i = 0 Then frmMain.mnuPlugin(i).Caption = "None" Else _
                Unload frmMain.mnuPlugin(i)
        End If
    Next i
    UnloadPlugins = True
End Function</pre>
<p>Вместо проверки IsActive можно было бы создать метод PluginClose, где плагин принудительно завершал бы свою работу.<br>
Функции, поддерживающие работу с плагинами на VB, объединены в классе clsPlugins (см. файл clsPlugins.cls). В примерах можно найти плагин Statistics, отображающий количество слов, символов и строк в поле EDIT, а также тестовый плагин, с которого можно начать разработку собственного плагина для TextPad на VB.<br>
VB обладает широкими возможностями. Например, можно создать AxtiveX EXE, добавить в проект глобальный класс и определить в нем интерфейс плагина:</p>
<pre class="code">Option ExplicitPublic Function MyFunctionOne(ByVal lData As Long) As Boolean
    \'
End FunctionPublic Sub MySubOne(ByVal strData As String)
    \' 
End SubPublic Property Get MyProperty() As Byte
    \'
End PropertyPublic Property Let MyProperty(ByVal bValue As Byte)
    \'
End Property</pre>
<p>После этого в проекте плагина подключается EXE (Project->References), и в глобальном классе "наследуется" интерфейс класса EXE:</p>
<pre class="code">Option ExplicitImplements SomeClassPrivate Function SomeClass_MyFunctionOne(ByVal lData As Long) As Boolean
    \'
End FunctionPrivate Property Let SomeClass_MyProperty(ByVal RHS As Byte)
    \'
End Property\'...</pre>
<p>Теперь ошибка реализации интерфейса плагина исключается. Можно объявить класс EXE в плагине как:</p>
<pre class="code">Public WithEvents MyClass As SomeClass</pre>
<p>А в проекте проинициализировать переменную MyClass:</p>
<pre class="code">Set hPlugin.MyClass = CSomeCls</pre>
<p>Теперь из плагина обеспечивается доступ ко всем событиям, генерируемым классом. Механизм событий позволяет управлять всеми плагинами одновременно.</p>
<h4>Примечание</h4>
<p>В рассмотренных примерах и для VC++, и для VB все плагины загружаются в память и не выгружаются до тех пор, пока не будет вызвана функция UnloadPlugins, что происходит только при завершении работы программы. Это удобно, но не экономично по отношению к памяти. Решением может стать динамическая загрузка/выгрузка плагинов по мере необходимости. Например, для VC++ вместо сохранения манипуляторов библиотек можно запоминать имена файлов, и при необходимости использовать их для вызова LoadLibrary:</p>
<pre class="code">char lpTmp[MAX_PATH] = { 0 };
pTPP[dwCnt]->lpPlugin = new char[128];
strcpy(pTPP[dwCnt]->lpPlugin, WFD.cFileName);

//...

strcpy(lpTmp, lpPlugPath);
strcat(lpTmp, "\\");
strcat(lpTmp, pTPP[dwCnt]->lpPlugin);
hVariable = LoadLibrary(lpTmp);

//...

FreeLibrary(hVariable)</pre>
<p>Аналогично для VB,  достаточно заменить массив ссылок на объекты строковым массивом, хранящим ProgID имеющихся плагинов, а при необходимости использовать сохраненные ProgID для вызова CreateObject:</p>
<pre class="code">strTPPlugArr(lFilesCnt) = GetTitle(strFileList) & ".clsMain"
Set hVariable = CreateObject(strTPPlugArr(lFilesCnt))\'...

Set hVariable = Nothing</pre>
<h3>Заключение</h3>
<p>Приведенные примеры демонстрируют только два из огромного множества способов реализации системы плагинов. Они просты для понимания, но не претендуют на звание самых эффективных и уж тем более универсальных методов. Поэтому читателю рекомендуется поэкспериментировать, попробовать создать свои методы на основе уже имеющихся и проверенных моделей. Так, например, для мультимедиа рекомендуется взять за основу Winamp SDK или foobar2000 SDK, для графики - GIMP SDK, для текста Notepad++ SDK или AbiWord SDK.</p>
<p>Автор: BV (borisbox@mail.ru)</p>
<br>
<hr>
<br>
<p>Слово "плагин" (от англ. Plug-in [Plugin] – подключаемый, съемный, сменный) отсутствует в русском языке, но в последнее время используется как синоним и сокращение словосочетания «подключаемый модуль»</p>
<p>У проекта типа ActiveX DLL, определен как минимум один COM-объект, у которого есть несколько базовых интерфейсов:
<ul>
	<li>IClassFactory - интерфейс для создания экземпляра этого COM-объекта</li>
	<li>%DefaultInterface% - основной интерфейс COM-объекта. Именно его метод QueryInterface должен вызываться IClassFactory->CreateInstance</li>
	<li>%DispInterface% - необязательный интерфейс, через который OLE Automation работает с событиями (Events)</li>
	<li>%OtherUDInterfaces% - прочие дополнительные интерфейсы, например, ISupportErrorInfo, IProvideClassInfo или пользовательские интерфейсы.</li>
</ul>
Все эти интерфейсы обязаны наследовать и реализовывать интерфейс IUnknown, опционально - IDispatch (для %DispInterface% IDispatch обязателен).<br>
<pre>COM-объект определяется в TypeLibrary директивой coclass (язык ODL - Object Description Language):
[
  uuid(00000000-0000-0000-0000-000000000000), //CLSID COM-объекта MyObject
  helpstring("MyObject")
]
coclass MyObject {
    [default] interface _IMyObject; //Основной интерфейс объекта
    [default, source] dispinterface _IMyObjectEvents; //Основной интерфейс событий объекта
    interface ... //Прочие интерфейсы объекта 
};</pre></p>';
	break;

//-------------------------------------------------------------------------------------------------------

case '1009/asing_programing.html':
	$site['page']['title'] .= ' - Асинхронное программирование';
	$site['page']['description'] .= ' Асинхронное программирование';
	$site['page']['keywords'] .= ', Асинхронное программирование';
	$site['page']['body'] .= '<h1>Асинхронное программирование</h1>
<b>Автор:</b> <noindex><a href="http://forum.sources.ru/index.php?showuser=26752" rel="nofollow" target="_blank"><i>juice</i></a></noindex>
<p>В предлагаемой статье пойдет разговор о написании Concurrent кода. Зачастую программисты, не имеющие достаточной теоретической базы, не в состоянии аргументировать принимаемые ими при разработке приложений решения. Их знания строятся на некоторых предположениях, домыслах и, естественно, на шишках, которые им уже пришлось набить. Однако все перечисленное не гарантирует понимания и фундаментальных знаний. Обычно, найдя некоторый обходной путь, программист превозносит это решение как единственно правильное и безоговорочно верное. Никто не идеален, и каждый может легко признать нехватку знаний в различных областях, тем не менее, обмен опытом можно и нужно произвести.</p>
<p>Многие слышали об АРМ (Asynchronous Programming Model) – одном из известных паттернов для реализации выполнения асинхронного кода на платформе .NET. Существует и альтернативная модель асинхронного выполнения, которая построена на использовании событийной модели. События используются для уведомления вызывающего кода. В самом простом случае это код, который выполняется в созданном программистом дополнительном потоке и по окончании выполнения уведомляет родительский поток об окончании своей работы, вследствие чего родительский поток имеет возможность воспользоваться результатами труда дочернего.</p>
<p>Правильного ответа на вопрос «какую именно модель стоит использовать при разработке приложений» не существует. Каждая модель имеет свои преимущества и недостатки. Впрочем, есть некое обобщенное правило. Если клиентом кода является библиотека, то обычно используется APM, если же графический интерфейс, то правильным выбором будет реализация асинхронных вызовов, основанных на событийной модели.</p>
<p>Типичным представителем рассматриваемой модели является общеизвестный BackgroundWorker класс, сэкономивший программистам большое количество времени, но обсуждать этот класс неинтересно, так как он хорошо известен любому читателю, заинтересованному в обсуждаемой теме. Вместо этого в статье рассказывается, как правильно писать код, реализуя классы, подобные классу BackgroundWorker. Проблемы синхронизации cross-thread и GUI операций обсуждаются вскользь, основное время посвящено написанию реально полезного кода, который продемонстрирует на практике использование описываемого паттерна и поможет лучше понять, что может предложить.NET Framework и как нужно стараться писать свой код.</p>
<p>Для начала рассмотрим типичную задачу: инициализацию формы данными, получение которых требует значительного времени.</p>
<p>Довольно часто встречается ситуация «подвисания» некоторых приложений и форм в момент выполнения запрашиваемых пользователем действий. Чтобы понять, почему так происходит, достаточно понимать, что GUI в Windows всегда выполняется в единственном ассоциированном с ним потоке. Каждая презентационная технология в рамках .NET реализует специальный внутренний менеджер, который неустанно проверяет и пресекает все попытки работать с GUI из других потоков. Можно иметь много потоков, но взаимодействовать с GUI можно только в одном единственном. Бесполезно рассуждать, почему это именно так и кто виноват, это данность, с которой следует смириться. Можно только заметить, что это не всегда плохо, и такая модель предлагает некоторые бонусы. Так вот, как только приложение выполняет код, который занимает какое-либо значимое время из потока GUI, GUI перестает обрабатывать все поступающие ему сообщения, выполнение потока приостанавливается до конца выполнения кода, что приводит к отсутствию перерисовки, «подвисанию» и появлению различных сопутствующих явлений.</p>
<p>Далеко за примером ходить не надо: каждый хоть раз пользовался мастером Data Connection – Add Connection в студийном Server Explorer. После попытки выбрать сервер из комбобокса, окно уходит в «даун», а если попытаться подергать хидер, появляется устрашающая надпись о том, что приложение не отвечает на запросы. Конечно, это не так, рано или поздно нужный код выполнится, можно будет выбрать нужный сервер из списка. Причина происходящего очевидна. В момент опроса сети на наличие экземпляров было «заморожено» выполнение потока GUI, и приложение в это время не было способно сделать, что-либо полезное. Это плохой способ проектирования. Гораздо лучше стараться держать поток GUI свободным. Идеальный GUI выполняет в GUI потоке исключительно обращения к GUI элементам (чтение, запись) и синхронизацию, весь остальной код выполняется в параллельных потоках. Мир не идеален, но можно постараться сделать так, что бы он хотя бы чуть-чуть приблизился к этому.</p>
<p>Чтобы решить вышеприведенную проблему, достаточно тот код, который опрашивает сеть, выполнить в независимом от GUI потоке, а потом сообщить основному потоку, что код выполнился, передать результат его выполнения кода в основной поток, произвести синхронизацию и обновить данные в контролах. Звучит устрашающе, на в предложенной статье подробно исследуется первая частью проблемы, а известная статья PIL поможет разобраться с синхронизацией и обновлением. Все действительно просто.<br>
<br>
Синхронное API определяется следующим образом:</p>
<pre class="code"> public interface ISqlServerNetworkManager
    {
        IList<NetworkInstanceDesceriptor> EnumAvailableSqlServers();
    }</pre>
<p>Легко понять, что должна делать реализация данного интерфейса. Она должна возвращать список объектов, каждый из которых опишет доступный сервер в сети. Ниже для полноты картины приводится реализация NetworkInstanceDescriptor:</p>
<pre class="code"> public class NetworkInstanceDesceriptor
    {
        public NetworkInstanceDesceriptor(){}

        public NetworkInstanceDesceriptor(string name, string server, string instance)
        {
            Name = name;
            Server = server;
            Instance = instance;
        }

        public string Instance { get; set; }
        public string Server { get; set; }
        public string Name { get; set; }

        public override string ToString()
        {
            return String.Format("Name: {0} Server: {1} - Instance: {2}", Name, Server, Instance ?? "Default");
        }
    }</pre>
<p>.NET предлагает несколько способов выполнения перечисления серверов. В предлагаемой ниже имплементации используются возможности SMO. Для того, что бы код компилировался, нужно подключить в проект сборку Microsoft.SqlServer.Smo и добавить соответствующее пространство имен:</p>
<pre class="code">public class SqlServerNetworkManager : ISqlServerNetworkManager
    {
        public IList<NetworkInstanceDesceriptor> EnumAvailableSqlServers()
        {
            var descriptors = new List<NetworkInstanceDesceriptor>();
            using (DataTable table = SmoApplication.EnumAvailableSqlServers())
            {
                foreach (DataRow row in table.Rows)
                    descriptors.Add(BuildNetworkDescriptor(row));
            }

            return descriptors;
        }

        private static NetworkInstanceDesceriptor BuildNetworkDescriptor(DataRow row)
        {
            return new NetworkInstanceDesceriptor(row["Name"] as string,
                                                  row["Server"] as string,
                                                  row["Instance"] as string);
        }
     }</pre>
<p>В реализации синхронного API нет ничего из области Rocket Science, после выполнения запроса полученный DataTable обрабатывается построчно, а на выходе генерируется нужная коллекция.<br>
Программисты, реализовывавшие вышеописанный визард, об этом не подумали. Они просто вызвали синхронный метод, установили курсор в часики, после получения результата, заполнили комбобокс, сбросили курсор в дефолт и двинулись дальше. Так написано 90% всего программного обеспечения.<br>
<br>
Для добавления асинхронного метода потребуется, прежде всего, сам метод, который приведет к асинхронному вызову, а также событие, подписавшись на которое, клиент класса получит уведомление о том, что код выполнен, и сможет через аргументы события получить результат его выполнения. Метод void EnumAvailableSqlServersAsync() ничего прямо не возвращает клиенту потому тип возвращаемого значения void. Синхронный метод не требовал аргументов, потому и в асинхронном варианте они не требуются. Окончание Async в названии метода – правило хорошего тона. Программист, который будет пользоваться API, сможет сразу определить, что вызов метода приводит к асинхронной операции, а следовательно, вполне возможно, ему потребуется подписаться на событие, чтобы получить результат работы метода. Отметим, что в этом методе будет создаваться дополнительный поток, в котором и будет вызываться синхронная реализация.<br>
.NET Framework предоставляет стандартный базовый класс аргумента, который должен использоваться в данном случае, это AsyncCompletedEventArgs. В нем определены два важных свойства: Canceled и Error. Первое позволяет обработчику узнать, что выполнение потока было прервано по желанию пользователя, второе предоставляет возможность коду, выполняемому в дочернем потоке, сообщить родительскому об исключении, произошедшем при его выполнении.<br>
Это <b>очень</b> важно.<br>
Проведем один небольшой эксперимент.</p>
<pre class="code">static void Main(string[] args)
        {
            try
            {
                ThrowExceptionMethod(null);
            }
            catch
            {
                
            }

            Console.ReadLine();
        }

        private static void ThrowExceptionMethod(object o)
        {
            throw new Exception("Child thread exception");
        }</pre>
<p>Исключение поймано, и программа продолжает работать. Можно корректно обработать пойманное исключение, а затем восстановить нормальную работу приложения (если ошибка не была фатальной) или завершить приложение в мягкой для него форме.<br>
Пусть ThrowExceptionMethod вызывается из другого потока:</p>
<pre class="code">static void Main(string[] args)
        {
            try
            {
                ThreadPool.QueueUserWorkItem(ThrowExceptionMethod);
            }
            catch(Exception ex)
            {
                
            }

            Console.ReadLine();
        }

        private static void ThrowExceptionMethod(object o)
        {
            throw new Exception("Child thread exception");
        }</pre>
<p>Catch не возымел никакого действия. Необработанное в порожденных потоках исключение приводит к фатальному сбою приложения. В .NET, как видно из примера, существуют механизмы, которые мешают в главном потоке обработать исключения дочернего. Единственное, что остается – подписаться на AppDomain.UnhandledException, но это может оказаться полезным разве что для логирования. Восстановить работу приложения все равно не удастся.  Следовательно, обработка исключений в дочернем потоке является обязательной, если приложение не собирается аварийно завершаться из-за ошибки.<br>
Ниже приводится пример обработки исключения в дочернем потоке.</p>
<pre class="code">class Program
    {
        static void Main(string[] args)
        {
            try
            {
                ThreadPool.QueueUserWorkItem(ThrowExceptionMethod);
            }
            catch(Exception ex)
            {
                
            }

            Console.ReadLine();
        }

        private static void ThrowExceptionMethod(object o)
        {
            try
            {
                throw new Exception("Child thread exception");
            }
            catch(Exception ex)
            {
                
            }
        }
    }</pre>
<p>Приложение продолжает работать. Следует, впрочем, помнить, что просто ловить исключения нехорошо, их всегда нужно обрабатывать или бросать дальше, если они произошли в коде библиотеки.<br>
Возвращаясь к AsyncCompletedEventArgs и к его свойству Error, можно сказать, что оно предоставляет удобный способ обработать исключение дочерним потоком и выслать его «посылкой» главному. Если нужно передавать главному потоку не только обработанное исключение, но и результат выполнения метода, этот класс следует унаследовать. Хорошо, если наследник будет более универсальным и сможет использоваться с различными типами возвращаемых значений при написании любого ассинхронного API, хотя решение и без Generic имеет смысл во многих случаях разработки специализированных библиотеки.</p>
<pre class="code"> public class EnumAvailableSqlServersEventArgs<T> : AsyncCompletedEventArgs 
    {
        public EnumAvailableSqlServersEventArgs(T result, Exception error, bool cancelled, object userState)
            : this(error, cancelled, userState)
        {
            Result = result;
        }

        public EnumAvailableSqlServersEventArgs(Exception error, bool cancelled, object userState) : base(error, cancelled, userState)
        {
        }

        public T Result { get; set; }
    }</pre>
<p>Расширить наш интерфейс теперь выглядит так:</p>
<pre class="code">public interface ISqlServerNetworkManager
    {
        event EventHandler<EnumAvailableSqlServersEventArgs<IList<NetworkInstanceDesceriptor>>> EnumAvailableSqlServersComplited;
        IList<NetworkInstanceDesceriptor> EnumAvailableSqlServers();
        void EnumAvailableSqlServersAsync();
    }</pre>
<p>Был добавлен метод и событие, подписавшись на которое, клиент кода сможет корректно обработать полученный результат. Для генерации события воспользуемся стандартным паттерном:</p>
<pre class="code"> protected void InvokeEnumAvailableSqlServersComplited(EnumAvailableSqlServersEventArgs<IList<NetworkInstanceDesceriptor>> e)
        {
            EventHandler<EnumAvailableSqlServersEventArgs<IList<NetworkInstanceDesceriptor>>> complited = EnumAvailableSqlServersComplited;
            if (complited != null)
                complited(this, e);
        }</pre>
<p>Метод, запускающий код в отдельном потоке, выглядит следующим образом:</p>
<pre class="code"> public void EnumAvailableSqlServersAsync()
        {
            ThreadPool.QueueUserWorkItem(o =>
                                     {
                                         try
                                         {
                                             IList<NetworkInstanceDesceriptor> result = EnumAvailableSqlServers();
                                             InvokeEnumAvailableSqlServersComplited(new EnumAvailableSqlServersEventArgs<IList<NetworkInstanceDesceriptor>>(result,
                                             null,
                                             false,
                                             null));
                                         }
                                         catch (Exception ex)
                                         {
                                             InvokeEnumAvailableSqlServersComplited(new EnumAvailableSqlServersEventArgs<IList<NetworkInstanceDesceriptor>>(ex, false,
                                                                                                              null));
                                          }
                                      });
        }</pre>
<p>Вместо создания потока вручную, был использован ThreadPool. Вместо явной реализации метода, удовлетворяющего WaitCallback, было использовано лямбда выражение, вследствие чего код стал не только короче, но и понятнее. Реализация через ThreadPool прямолинейна, но имеет ряд ограничений. Впрочем, обычно этого достаточно для приложения. Главное, что это просто и безопасно, а изменить реализацию на более сложную всегда можно при надобности. Отдельно стоит отметить, что реализация возможности множественных вызовов асинхронного метода здесь никак не обрабатывается, хотя было бы не плохо это предусмотреть.<br>
Можно было реализовать такую возможность через управляющий флаг (IsBusy или InProgress), что позволило бы клиенту класса проверять возможность повторного обращения, а код, обнаруживая множественные вызовы, мог бы бросать исключение. Другой способ менее тривиален и состоит в том, что бы передавать в Async метод дополнительный параметр, уникально идентифицирующий вызов (object tasked). При генерации события для клиента класса этот taskId мог бы передаваться обработчику. Дополнительный плюс состоит в том, что данный идентификатор можно использовать при реализации возможности отмены конкретных "тасков".<br>
Стоит обратить внимание, что исключения, которые могут возникнуть при выполнении кода в порождаемом пулом потоке, перехватываются. В случае возникновения такого исключения генерируется событие, и в конструктор аргумента передается само исключение, если же код выполнился нормально,  генерируется событие, которое позволит вызывающему коду получить результат выполнения.<br>
Ниже приводится консольное приложение, которое использует реализованный класс.</p>
<pre class="code">static void Main(string[] args)
        {
            var manager = new SqlServerNetworkManager();
            manager.EnumAvailableSqlServersComplited += ManagerEnumAvailableSqlServersComplited;
            manager.EnumAvailableSqlServersAsync();
            Console.ReadLine();
        }

        static void ManagerEnumAvailableSqlServersComplited(object sender, EnumAvailableSqlServersEventArgs<IList<NetworkInstanceDesceriptor>> e)
        {
            if (e.Error == null)
            {
                foreach (var instance in e.Result)
                    Console.WriteLine(instance);
            }
            else
            {
                Console.WriteLine("Пользователь видит окно с ошибкой");
            }
        }
</pre>
<p>Здесь происходит подписка на событие и вызов асинхронный метода. Обработчик получает результат и выводит его на консоль.<br>
<br>
Используя такую модель при работе с GUI, нельзя забывать синхронизировать доступ. Можно синхронизировать код с помощью cross-thread в GUI. Зачастую этот подход обоснован, но он не единственен. Например, выше был упомянут компонент BackgroundWorker, который умеет работать с GUI и синхронизировать операции его обновления. Кроме того, можно ввести автоматический маршалинг кода, выполняемого асинхронно, в поток GUI. Это, безусловно, усложняет код, но делает работу с классом более удобной. .NET Framework позволяет использовать удобные механизмы для маршалинга кода с потока в поток.<br>
Базовую функциональность, связанную с маршалингом, предоставляет класс SynchronizationContext. Его наследники обычно реализуют возможность синхронизации вызовов для конкретной технологии. Такие классы имеются в WPF, WindowsForms, APS.NET. Наследование используется для обеспечения возможности работать с контекстом через базовый класс, не задумываясь при написании компонентов о конкретной технологии. Самыми важными методами  контекста синхронизации являются Post и Send. Именно они производят маршализацию. Базовый класс имеет наивные реализации. Например, Post использует ThreadPool, а Send – обычный синхронный вызов делегата, зато эти методы объявлены как виртуальные, что и позволяет классам наследникам определять свои собственные механизмы маршалинга. Ниже показана реализация методов в классе SynchronizationContext:</p>
<pre class="code"> public virtual void Post(SendOrPostCallback d, object state)
    {
        ThreadPool.QueueUserWorkItem(new WaitCallback(d.Invoke), state);
    }</pre>
<p>Для вызова метода через делегат используется пул потоков.</p>
<pre class="code">public virtual void Send(SendOrPostCallback d, object state)
    {
        d(state);
    }</pre>
<p>Идет прямой вызов посредством делегата.<br>
<br>
Ниже показана реализация методов в классе WindowsFormsSynchronizationContext, наследнике контекста синхронизации.</p>
<pre class="code">public override void Post(SendOrPostCallback d, object state)
    {
        if (this.controlToSendTo != null)
        {
            this.controlToSendTo.BeginInvoke(d, new object[] { state });
        }
    }

    public override void Send(SendOrPostCallback d, object state)
    {
        Thread destinationThread = this.DestinationThread;
        if ((destinationThread == null) || !destinationThread.IsAlive)
        {
            throw new InvalidAsynchronousStateException(SR.GetString("ThreadNoLongerValid"));
        }
        if (this.controlToSendTo != null)
        {
            this.controlToSendTo.Invoke(d, new object[] { state });
        }
    }</pre>
<p>Метод Post пользуется тем, что контекст имеет ссылку на Control из Windows Forms, а каждый контрол предоставляет метод BeginInvoke, позволяющий запустить код в потоке GUI. В методе Send ситуация не сложнее: когда контекст создается, он получает ссылку на поток  this.DestinationThread = Thread.CurrentThread;  это код из конструктора. После проверки валидности потока, применяется тот же прием что и в методе Post, но в синхронном исполнении. Ниже представлен полный код конструктора, понятный без дополнительных пояснений:</p>
<pre class="code">public WindowsFormsSynchronizationContext()
{
    this.DestinationThread = Thread.CurrentThread;
    Application.ThreadContext context = Application.ThreadContext.FromCurrent();
    if (context != null)
    {
        this.controlToSendTo = context.MarshalingControl;
    }
}</pre>
<p>Статическое свойство Current возвращает ссылку на контекст.</p>
<p>Существует вспомогательный класс AsyncOperatonManager. Он имеет свойство SynchronizatoinContext, возвращающее ссылку на текущий контекст синхронизации, а также фабричный метод CreateCommand, который возвращает объект AsyncOperation. Свойство SynchronizatoinContext, проверяет, существует ли установленный контекст синхронизации, и если существует, возращает его, если же нет, возвращает дефолтную реализация SynchronizatoinContext. Это свойство просто экономит несколько лишних строчек кода при обращении к контексту. Например, не нужно проверять его на null. Метод CreateCommand создает команду, которая  имеет ссылку на текущий контекст синхронизации. Она позволяет сохранить некое пользовательское состояние, кроме того, она имеет и собственное состояние (выполнена или нет). Когда команда выполнена, она может сообщить об этом контексту, что бы он корректно освободил необходимые ресурсы. Алгоритм следующий: посредством вызова AsyncOperatonManager?CreateOpperation, создается команда; передается, если необходимо, пользовательский объект, служащий параметром асинхронного метода; затем AsyncOperatonManager устанавливает команде текущий контекст, устанавливает команде поле _complited в false и вызывает метод контекста OperationStarted. Дефолтный контекст имеет пустую реализацию, зато наследники, такие как WindowsFormsSynchronizationContext, могут определять собственную логику по отслеживанию операции маршалинга (хотя за исключением контекста для ASP.NET, никто этого не делает).<br>
Каждая команда имеет методы Post и Send, которые делегируют всю нужную работу ассоциированному контексту, проверяя, что делегат не null, а собственное состояние команды установлено в «не выполнено». Команда в состоянии «выполнена» более не пригодна к использованию. Это сделано для того, чтобы корректно освобождать ресурсы. Еще один полезный метод – PostOperationComplited, он тоже делегирует вызов через Post, но дополнительно устанавливает команду в состояние «выполнена».<br>
<br>
Ниже рассматривается применения на практике вышеизложенных теоретических сведений. Объявляется переменную private AsyncOperation _currentOperation;<br>
<br>
Пусть клиентский код не допускает несколько параллельных асинхронных вызовов.<br>
В EnumAvailableSqlServersAsync инициализируется команда. Вот тело метода:</p>
<pre class="code"> _currentOperation = AsyncOperationManager.CreateOperation(null);


            ThreadPool.QueueUserWorkItem(obj =>
             {
                 Exception execption = null;
                 IList<NetworkInstanceDesceriptor> result = null;

                 try
                 {
                     result = EnumAvailableSqlServers();
                 }
                 catch (Exception ex)
                 {
                     execption = ex;
                 }
                 finally
                 {
                     CombineResults(result, execption);
                 }
             });</pre>
<p>Вместо непосредственной генерации события об окончании выполнения, вызывается CombineResult для сбора EnumAvailableSqlServersEventArgs<IList<NetworkInstanceDesceriptor>> и выполнения маршализации в поток GUI с помощью команды, вызывая для ней PostOperationCompleted. Ниже приведена реализация этого метода:</p>
<pre class="code">private void CombineResults(IList<NetworkInstanceDesceriptor> result, Exception exception)
        {
            var args = new EnumAvailableSqlServersEventArgs<IList<NetworkInstanceDesceriptor>>(result, exception, false, null);
            _currentOperation.PostOperationCompleted(_onCompletedDelegate, args);
        }</pre>
<p>Первым параметром метода PostOperationCompleted  является делегат SendOrPostCallback. До вызова метода, назначенного делегату, мы находимся в коде, вызываемом через пул, после же этого (после маршализации), оказываемся в потоке GUI, если, конечно, код выполнялся в WinForms или WPF.</p>
<p>Делегат предварительно нужно объявить в программе:</p>
<pre class="code">private readonly SendOrPostCallback _onCompletedDelegate;M</pre>
<p>и в конструкторе класса проинициализировать его:</p>
<pre class="code">public SqlServerNetworkManager()
        {
            _onCompletedDelegate = new SendOrPostCallback(AsyncCallCompleted); 
        }</pre>
<p>Для инициализации используется следующий метод:</p>
<pre class="code">private void AsyncCallCompleted(object operationState)
        {
            var e = operationState as EnumAvailableSqlServersEventArgs<IList<NetworkInstanceDesceriptor>>;
            InvokeEnumAvailableSqlServersComplited(e);
        }</pre>
<p>Внутри этого метода мы уже в потоке GUI, если код выполнялся в WinForms или WPF. То есть, уже имеется маршализированное значение, и остается только сгенерировать соответствующее событие для уведомления клиента о том, что операция выполнена.<br>
<br>
Последний штрих – добавление свойства IsBusy.</p>
<pre class="code">private bool _isBusy;

        public bool IsBusy
        {
            get { return _isBusy; }
            protected set { _isBusy = value; }
        }</pre>
<p>Когда вызывается EnumAvailableSqlServersAsync, нужно проверить, что код не занят:</p>
<pre class="code">if (IsBusy)
                throw new InvalidOperationException();

            IsBusy = true;</pre>
<p>и установить IsBusy в true, а после выполнения маршализации можно снова разрешить использование метода EnumAvailableSqlServersAsync:</p>
<pre class="code">private void CombineResults(IList<NetworkInstanceDesceriptor> result, Exception exception)
        {
            var args = new EnumAvailableSqlServersEventArgs<IList<NetworkInstanceDesceriptor>>(result, exception, false, null);
            _currentOperation.PostOperationCompleted(_onCompletedDelegate, args);
            IsBusy = false;
        }</pre>
<p>В результате получается код, позволяющий клиенту вызывать его асинхронно, причем результат работы этого кода не требует никакой синхронизации с GUI. Это удобно.<br>
<br>
Ниже приводится код с небольшими комментариями:</p>
<pre class="code"> public class SqlServerNetworkManager : ISqlServerNetworkManager
    {
        private bool _isBusy;
        private readonly SendOrPostCallback _onCompletedDelegate;

        // используется для маршализации обращений между потоками
        private AsyncOperation _currentOperation;

        // подписавшись на событие, клиент получит результат. Он сможет обработать результат или просто узнать об ошибке
        public event EventHandler<EnumAvailableSqlServersEventArgs<IList<NetworkInstanceDesceriptor>>> EnumAvailableSqlServersComplited;

        public SqlServerNetworkManager()
        {
            _onCompletedDelegate = new SendOrPostCallback(AsyncCallCompleted); 
        }

        public bool IsBusy
        {
            get { return _isBusy; }
            protected set { _isBusy = value; }
        }

        private void AsyncCallCompleted(object operationState)
        {
            // Находясь здесь после синхронизации, можно без проблем обращаться к GUI.
            var e = operationState as EnumAvailableSqlServersEventArgs<IList<NetworkInstanceDesceriptor>>;
            InvokeEnumAvailableSqlServersComplited(e);
        }

        // Синхронная реализация
        public IList<NetworkInstanceDesceriptor> EnumAvailableSqlServers()
        {
            var desceriptors = new List<NetworkInstanceDesceriptor>();
            using (DataTable table = SmoApplication.EnumAvailableSqlServers(false))
            {
                foreach (DataRow row in table.Rows)
                    desceriptors.Add(BuildNetworkDescriptor(row));
            }

            return desceriptors;
        }

        // Асинхронная реализация
        public void EnumAvailableSqlServersAsync()
        {
            // Нельзя обращаться к коду до конца выполнения маршализации, 
            // клиенту предоставляется свойство IsBusy для того, 
            // чтобы он мог проверить возможность вызова
            if (IsBusy)
                throw new InvalidOperationException();

            IsBusy = true;

            _currentOperation = AsyncOperationManager.CreateOperation(null);

            ThreadPool.QueueUserWorkItem(obj =>
             {
                 Exception execption = null;
                 IList<NetworkInstanceDesceriptor> result = null;

                 try
                 {
                     result = EnumAvailableSqlServers();
                 }
                 catch (Exception ex)
                 {
                     execption = ex;
                 }
                 finally
                 {
                     CombineResults(result, execption);
                 }
             });
           
        }

        // результат работы кода собирается в аргумент события и маршализируется между потоками
        private void CombineResults(IList<NetworkInstanceDesceriptor> result, Exception exception)
        {
            var args = new EnumAvailableSqlServersEventArgs<IList<NetworkInstanceDesceriptor>>(result, exception, false, null);
            _currentOperation.PostOperationCompleted(_onCompletedDelegate, args);
            IsBusy = false;
        }

        private static NetworkInstanceDesceriptor BuildNetworkDescriptor(DataRow row)
        {
            return new NetworkInstanceDesceriptor(row["Name"] as string,
                                                  row["Server"] as string,
                                                  row["Instance"] as string);
        }

        protected void InvokeEnumAvailableSqlServersComplited(EnumAvailableSqlServersEventArgs<IList<NetworkInstanceDesceriptor>> e)
        {
            EventHandler<EnumAvailableSqlServersEventArgs<IList<NetworkInstanceDesceriptor>>> complited = EnumAvailableSqlServersComplited;
            if (complited != null)
                complited(this, e);
        }
    }</pre>';
	break;

//-------------------------------------------------------------------------------------------------------

case '1009/motchet.html':
	$site['page']['title'] .= ' - Менеджер отчётов';
	$site['page']['keywords'] .= ', Менеджер отчётов';
	$site['page']['body'] .= '<h1>Менеджер отчётов</h1>
<b>Автор:</b> <i>Савельев Андрей</i>
<p>Существует коммерческий проект «АРМ Торговля и склад», предназначение которого состоит в автоматизации работы на складе и на кассе в торговом зале. Проект содержит модуль «Склад», подразумевающий формирование и хранение группы документов: приходные и расходные документы, списание и возврат товара, продажи по кассе и т.д. Каждой группе документов соответствуют свои отчеты. Например, к приходным и расходным документам относятся такие отчёты как «Приходная и расходная накладная» и «Печать ценников на оприходованный товар». К списанию товара или передаче его в другой отдел относятся «Акт на списание» и «Накладная на списание», а к документам продажи по кассе относятся «Список чеков на дату» и «Справка-отчёт кассира-операциониста». Отчетов множество, и выполнение того или иного из них для определённого документа представляет трудность, преодолеть которую позволит <b>менеджер отчетов</b>.</p>
<p>Первоначально необходимо определить состав таблицы, в которой будут храниться физические названия и описание отчётов. Пусть таблица называется RPT_LIST и имеет следующую структуру:</p>
<p> - ID_RPT // нумерация позиций отчётов<br>
 - NAME_RPT //название отчёта<br>
 - COMMENT_RPT // комментарий для отчёта<br>
 - VALUE_RPT // значение, которому будет соответствовать тип операции<br>
 - NAME_RPT_SHOT // физическое название отчёта</p>
<pre class="code">DDL таблицы
CREATE TABLE RPT_LIST (
    ID_RPT          INTEGER NOT NULL,
    NAME_RPT        VARCHAR(50) NOT NULL,
    COMMENT_RPT     VARCHAR(255) NOT NULL,
    VALUE_RPT       INTEGER NOT NULL,
    NAME_RPT_SHORT  VARCHAR(50) NOT NULL
);</pre>
<p>Для работы с таблицей создается проект Delphi. На форму бросим Panel, на панели разместим DBGrid и DBMemo, а также три кнопки, которые назовём btnPreview, btnPrint, btnExit. Выставим Align у компонентов так, как это показано на рис. 1.<br>
Кроме того, создадим DataMoule и поместим туда IBDataBase, IBTransaction, IBQuery, DataSources, и свяжем их обычным способом (подробнее рассмотрено в примере).</p>
<center><img src="'. $site['setting']['base'] .'/img/num/09/04/1.png" width="464" height="316" alt="Менеджер отчётов"><br>
Рис. 1 – Окно проекта</center>
<p>Алгоритм действий прост: при открытии формы в DBGrid’е формируется список отчётов в зависимости от выбранного типа операции. За тип операции отвечают RatioButton’ы, по умолчанию выбран тип «Приход». При выборе в DBGrid’е необходимого отчёта в DBMemo отображается его краткое описание. Выбранный отчёт можно предварительно просмотреть или сразу вывести на печать.<br>
Ниже представлен полный код проекта.<br>
<br>
Код модуля DataModule (назван в примере dm)</p>
<pre class="code">procedure Tdm.DataModuleCreate(Sender: TObject);
begin
// вызывается процедура подключения БД
  frmMain.OpenBD;
// Открывается DataSet для первичного формирования группы отчётов
// для определённого типа операции
  IRep.Open;
end;</pre>
<p>Код главной формы frmMain</p>
<pre class="code">//процедура, которая отвечает за динамическое подключение БД
procedure TfrmMain.OpenBD;
begin
  //путь до БД
  dm.IBDatabase.DatabaseName := ExtractFilePath(Application.ExeName)+\'\base.fdb\';;

  with dm do
    begin
      try
        IBDatabase.Connected := True;
        IBTransaction.Active := True;
      except
        on E:Exception do
        begin
          Application.MessageBox(PChar(\'Не удалось подключиться к серверу!\' +
            #10#13+#10#13 + e.Message),\'Пример\',MB_OK + MB_ICONERROR);
            Close;
        end;
      end;
    end;
end;

procedure TfrmMain.RadioButton1Click(Sender: TObject);
begin
  with dm.IRep do
    begin
      close;
      sql.Clear;
      sql.Text := \'select * from rpt_list where value_rpt = \' + QuotedStr(IntToStr((Sender as TRadioButton).Tag));
      Open;
    end;
end;

//кнопка просмотра
procedure TfrmMain.btnPreviewClick(Sender: TObject);
begin
  //Создание объекта
  Rep := TfrxReport.Create(self);
  //загрузка отчёта
  Rep.LoadFromFile(ExtractFilePath(Application.ExeName)+dm.IRep.FieldByName(\'name_rpt_short\').AsString);
  //просмотр отчёта
  if rep.PrepareReport then
    rep.ShowPreparedReport;
  //освобождение памяти
  rep.Free;
end;

procedure TfrmMain.btnExitClick(Sender: TObject);
begin
 Close;
end;

// кнопка печати
procedure TfrmMain.btnPrintClick(Sender: TObject);
begin
  //Создание объекта
  Rep := TfrxReport.Create(self);
  //загрузка отчёта
Rep.LoadFromFile(ExtractFilePath(Application.ExeName)+dm.IRep.FieldByName(\'name_rpt_short\').AsString);
  //печать отчёта
  if Rep.PrepareReport then
    Rep.Print;
  //освобождение памяти
  Rep.Free;
end;</pre>
<p>Работа менеджера показана на рис. 2.</p>
<p><center><img src="'. $site['setting']['base'] .'/img/num/09/04/2.png" width="464" height="316" alt="Менеджер отчётов"><br>
Рис. 2 – Работа приложения</center></p>
<p>Рассмотренные примеры прилагаются в архиве. Следует помнить, что база данных создавалась на СУБД FireBird 1.5.4 и для работы примера необходимо, чтобы данная СУБД была установлена.<br>
<br>
<i>Савельев Андрей</i></p>';
	break;

//-------------------------------------------------------------------------------------------------------

case '1009/pascal_to_delphi.html':
	$site['page']['title'] .= ' - Секреты Delphi или переход с Pascal’я';
	$site['page']['description'] .= ' Секреты Delphi или переход с Pascal’я';
	$site['page']['keywords'] .= ', Delphi переход Pascal, Секреты Delphi Pascal';
	$site['page']['body'] .= '<h1>Секреты Delphi или переход с Pascal’я</h1>
<b>Автор:</b> <noindex><a href="http://forum.sources.ru/index.php?showuser=32311" rel="nofollow" target="_blank"><i>Profi</i></a></noindex>
<p>Обычно начинающие программисты, переходя с языка Pascal на Delphi, перетаскивают свои старые функции и прочие участки часто встречающегося кода без изменений, не зная, сколько всего уже реализовано в VCL. Причина чаще всего в том, что при преподавании языка Pascal в учебных заведениях рассматриваются только модули CRT и Graph, содержащие базовые функции, а современные технические писатели, описывающие Delphi, рассматривают только малую часть всех возможностей данного языка. Вот и выходит, что код загромождается лишними, часто неоптимизированными функциями.<br>
Так было и со мной, когда после года изучения языка Pascal в ВУЗе, я решил сам освоить Delphi. Купил несколько книг, разобрался с тем, как создавать формы, вводить и выводить данные, стал писать простые программы. Но чем больше я углублялся в Delphi, тем чаще стал замечать, что большая часть написанного мною кода уже реализована в стандартных модулях. Изучая исходный код VCL, я открыл для себя много замечательных функций и типов, которые здорово облегчили бы мне работу над многими программами. Сейчас, разрабатывая уже достаточно сложные программы, прежде чем написать какую-нибудь функцию, производящую более-менее стандартные действия, я проверяю, нет ли уже её реализации в VCL, и процентах в тридцати случаев оказывается, что есть.<br>
Недавно я открыл для себя замечательный модуль ConvUtils и решил рассказать новичкам, стремящимся изучить замечательный язык программирования Delphi, о скрытых функциях и возможностях, которые почти нигде не описаны и сразу не бросаются в глаза.</p>
<h2>Рефакторинг</h2>
<p>Среда разработки предоставляет множество возможностей, облегчающих жизнь. Все знают про то, что после точки Delphi выводит набор свойств и методов, доступных в данном классе. Но про то, что если нажать Ctrl+Пробел, то среда предложит набор функций и констант, доступных во всех подключенных модулях, а также все переменные, свойства и методы данного модуля, знают немногие.<br>
Многим не нравится то, что в Pascal (а значит, и в Delphi) переменные объявляются в специальной секции Var, и часто для того, чтобы объявить новую переменную, приходится прокручивать много кода. В последних версиях Delphi эта «проблема» решена: достаточно в любом месте кода написать var и нажать Tab. Среда создаст строку: LVar: Integer. Если теперь написать имя будущей переменной, нажать Tab, задать тип и нажать Tab еще раз, среда сама переместит переменную в секцию var. Так же этот сервис доступен через Ctrl+Пробел. Можно сделать иначе: написать имя будущей переменной в коде функции, навести на неё курсор и нажать Shist+Ctrl+V. Появится окно «Declare Variable». В поле Name будет имя новой переменной, которое нельзя изменить. В поле Type – тип будущей переменной, его можно изменить, если среда определила его неверно. Если включить флажок Array, среда создаст динамический массив указанного типа с глубиной вложенности, указанной в поле Dimensions. Если включить флажок Set Value, среда позволит указать значение переменной, присваиваемое ей при инициализации. Новую переменную можно сделать полем некоторого класса. Для этого надо нажать Shift+Ctrl+D. Появится окно «Declare New Field», содержащее те же поля, что и «Declare Variable».<br>
Еще одна замечательная возможность среды – Extract Method. Предположим, что при написании какой-то функции оказывается, что часть кода будет использоваться где-то еще. Можно при написании другой функции скопировать необходимую часть кода, объявить те же переменные, присвоить им значения, в общем, подогнать код под другие условия. А можно использовать этот код как отдельную функцию. Но вырезка уже написанных строк, создание новой функции с необходимыми параметрами и встраивание в неё кода займет больше времени и труда, чем выделение написанного, и нажатие Shift+Ctrl+M. Появится новое окно «Extract Method». В поле «New method name» вводим имя нового метода, а в поле «Sample extracted code» будет представлен будущий код. При этом все переменные, которые используются только внутри выделенного участка, перенесутся в секцию Var нового метода, а все переменные, которые используются и в окружающем выделенный фрагмент коде, будут переданы в новый метод в качестве параметров. Нажмем ok, и выделенные строки перенесутся в новый метод, а на их месте появится его вызов. Конечно, не всегда новый метод создается безупречно, иногда приходится что-то править вручную, однако эта возможность действительно очень удобна.<br>
Так же стоит обратить внимание на «Sync Edit Mode». Предположим, что в уже написанном и отлаженном модуле, содержащем приличное количество строк, нужно изменить имя глобальной переменной. Это несложно, но потом приходится тратить немало времени, переименовывая эту переменную везде, где она встречается. Пользоваться вслепую функцией «Замена» тоже удается не всегда, например, когда надо переименовать переменную имя которой содержится в именах других переменных и методов. Можно возложить работу на компилятор и попытаться скомпилировать модуль, а потом пройтись по всем ошибкам, исправляя имена переменных. Но самый быстрый и верный способ решения данной задачи заключается в выделении текста всего модуля комбинацией Ctrl+A, нажатии Shift+Ctrl+J и изменении имени переменной только там, где она объявлена. Среда сама переименует её везде, где она используется. Замечу, что так можно изменять не только имена переменных, но и имена методов и свойств классов, имена самих классов и имена функций и процедур. Также можно выделять текст не всего модуля, а некоторого фрагмента. Изменить имя именно переменной можно еще одним способом: навести курсор на переменную, которую надо переименовать, и нажать Shift+Ctrl+E. В появившемся окне «Rename variable» в поле «New name» задается новое имя. Если оставить галочку «View reference before refactoring», то среда перед переименованием сначала покажет все места, где встречается переменная, для подтверждения программистом.</p>
<h2>Работа со строками</h2>
<h4>Поиск подстроки в строке</h4>
<p>Обычно программист, перешедший с Pascal на Delphi, сам пишет функцию поиска подстроки в строке. Выглядит она примерно так:</p>
<pre class="code">Function FindSubStrInStr(Const Str,SubStr:string):Boolean;
Var
    i,j:integer;
Begin
    Result:=false;
    For i:=1 to Length(str) do 
    begin
        If (Str[i]=SubStr[1]) and (Length(substr)<=Length(Str)-(i-1)) then 
        begin
            Result:=true;
            For j:=2 to Length(SubStr) do 
            begin
                If SubStr[j]<>Str[i+j-1] then 
                begin
                    Result:=false;
                    Break;
                End;
            End;
        End;
    If Result Then
        Break;
    End;
End;</pre>
<p>Создание и отладка этой функции занимает от 3х минут, и то, если программист некогда уже писал что-то подобное и имел представление что ему нужно. Но в стандартном модуле System уже есть замечательная функция Pos. Программист, знающий о её существовании потратит на ту же задачу секунд десять.</p>
<p><b>Функция Pos</b>:<br>
<i>Параметры</i>:<br>
1. Подстрока, тип string.<br>
2. Строка, тип string.<br>
<i>Возвращаемое значение</i>:<br>
Тип integer. Функция возвращает индекс первого символа подстроки в строке. Если подстрока не найдена – 0.<br>
Впрочем, описание функции Pos все-таки иногда встречается в книгах.</p>
<h3>Подсчет вхождений подстроки в строку.</h3>
<p>Вторая похожая задача: подсчитать количество вхождений подстроки в строку. Можно переписать имеющуюся функцию примерно так, потратив те же примерно 3 минуты:</p>
<pre class="code">Function CountSubStrInStr(Const Str, SubStr:string):Integer;
Var
    i,j:integer;
    find:Boolean;
Begin
    Result:=0;
    For i:=1 to length(str) do 
    begin
        Find:=false;
        If (Str[i]=SubStr[1]) and (Length(substr)<=Length(Str)-(i-1)) then 
        begin
            Find:=true;
            For j:=2 to Length(SubStr) do 
            begin
                If SubStr[j]<>Str[i+j-1] then 
                begin
                    Find:=false;
                    Break;
                End;
            End;
        End;
    If Find Then
        Inc(Result);
    End;
End;</pre>
<p>Но можно подключить к проекту модуль StrUtils в котором есть функция PosEx.<br>
<b>Функция PosEx</b>:<br>
<i>Параметры</i>:<br>
1. Подстрока, тип string.<br>
2. Строка, тип string.<br>
3. Смещение (индекс символа, с которого начинается поиск), тип integer;<br>
<i>Возвращаемое значение</i>:<br>
Тип integer. Функция возвращает индекс первого символа подстроки в строке. Если подстрока не найдена – 0.<br>
Теперь функция CountSubStrInStr будет выглядеть так:</p>
<pre class="code">Function CountSubStrInStr(Const Str, SubStr:string):Integer;
var
    i:integer;
begin
    Result:=0;  // Значение по умолчанию 0 (подстрок не найдено).
    i:=1; // Поиск начинается с первого символа.
    repeat
        i:=PosEx(SubStr,Str,i);  // Присвоение i результата работы PosEx.
        if i<>0 then // Если подстрока найдена…
        begin
            Inc(Result); //…увеличение результата на единицу…
            i:=i+Length(SubStr); //…и увеличение значения i на длину подстроки.
        end;
    until i=0; //Выход из цикла, если подстрок больше (вообще) не найдено.
end;</pre>
<p>Смотрится функция в таком виде куда лучше, да и скорость выполнения значительно выше.</p>
<h3>Разбиение предложения на слова</h3>
<p>Студент-первокурсник потратит на решение этой задачи минут 40. Более-менее опытный программист - минут 10. Результат будет примерно слудующим:</p>
<pre class="code">Procedure DivideString(const Str:string; StrList:TStrings);
Type
    Mnoj=set of char;
Var
    i:integer;
    subs:string;
Сonst
    Mn:Mnoj=[\'А\'..\'Я\', \'а\'..\'я\', \'0\'..\'9\', \'-\', #39];
Begin
    subs:=\'\';
    for i:=1 to length(str) do 
    begin
         if not (str[i] in Mn) then 
             Continue;
         subs:=subs+str[i];
         if (not (str[i+1] in Mn)) or (i=length(str)) then 
         begin
             StrList.Add(subs);
             subs:=\'\';
         end;
     end;
End;</pre>
<p>Функция вполне работоспособна и отлично справляется со своими обязанностями, разбивая строку за один проход. Но вместо 10 минут можно потратить одну, использовав в коде функцию ExtractStrings.<br>
<b>Функция ExtractStrings:</b><br>
<i>Параметры:</i><br>
1. Множество символов, используемых в качестве делителей, тип TSysCharSet.<br>
2. Множество символов, которые будут игнорироваться только если они находятся в начале строки, тип TSysCharSet.<br>
3. Строка, тип PChar.<br>
4. Список строк, в который будут добавлены получившиеся в результате разбиения слова, тип TStrings.<br>
<i>Возвращаемое значение</i>:<br>
Тип integer. Функция возвращает количество получившихся в результате разбиения строки слов.<br>
<br>
Единственный минус этой функции в том, что нельзя обработать символ «’» в сочетании с русскими буквами. То есть если вводится строка «Computed solution d’Alembert’s force», функция возвращает вполне ожидаемые четыре слова. А если ввести «Найденное решение и есть д’Аламберова сила», то функция просто откажется разбивать строку после «’», вернув все оставшиеся слова как одно. То есть, получится пять слов вместо шести.</p>
<h1>Математические операции</h1>
<h3>Возведение в степень</h3>
<p>В коде неопытных программистов можно часто встретить следующее:<br>
y:=x*x;<br>
Иногда это полезно для наглядности, но ведь есть функция Sqr.<br>
<br>
<b>Функция Sqr</b>:<br>
<i>Параметры</i>:<br>
1. Число, тип Extended.<br>
<i>Возвращаемое значение</i>:<br>
Тип Extended. Квадрат числа, переданного в функцию.<br>
Согласитесь, код:<br>
<pre class="code">y:=Sqr(Sqr(x));</pre>
выглядит лучше, чем:<br>
<pre class="code">y:=x*x*x*x;</pre>
Но еще лучше выглядит такой код:<br>
<pre class="code">y:=IntPower(x,4);</pre>
<br>
<b>Функция IntPower</b>:<br>
<i>Параметры</i>:<br>
1. Основание, тип Extended.<br>
2. Степень, тип Integer.<br>
<i>Возвращаемое значение</i>:<br>
Тип Extended. Основание, возведенное в степень.<br>
Функция IntPower идеально подходит для возведения в целую степень, если же нужно возвести число в вещественную степень, подойдет функция Power.<br>
<br>
<b>Функция Power</b>:<br>
<i>Параметры</i>:<br>
1. Основание, тип Extended / Double / Single.<br>
2. Степень, тип Extended / Double / Single.<br>
<i>Возвращаемое значение</i>:<br>
Тип Extended / Double / Single. Основание, возведенное в степень.<br>
Конечно, функцию Power можно использовать и для возведения в целую степень, но функция IntPower справится с этим гораздо быстрее.<br>
А на Pascal в свое время приходилось писать примерно такие функции:</p>
<pre class="code">function Power (const Base, Exponent:Real):Real
begin
  Power:=0;
  If 0 < Base then
    Power:=Exp(Exponent*Ln(Base));
end;</pre>
<h1>Работа с массивами</h1>
<p>Массив – один из основных типов данных в Pascal и Delphi. Конечно, сейчас в основном используются разнообразные списки, а с появлением .Net 2.0 и Delphi 2009 стало достаточно легко добавлять новые, однако в самом начале знакомства с Delphi программисты в основном используют массивы.</p>
<h3>Перебор значений массива</h3>
<p>Обычно перебор элементов массива выглядит примерно так:</p>
<pre class="code">var
  ms: array [0..99] of Integer;
  I: Integer;
begin
  for I := 0 to 99 do
    ShowMessage(IntToStr(ms[I]));
end;</pre>
<p>Но если вдруг количество элементов изменится, то придется переписать начальное и конечное значения I. Чтобы об этом не думать, можно использовать функции Low и High:</p>
<pre class="code">var
  ms: array [0..99] of Integer;
  I: Integer;
begin
  for I := Low(ms) to High(ms) do
    ShowMessage(IntToStr(ms[I]));
end;</pre>
<h1>«Книга, а в ней кукиш да фига»</h1>
<p>Так гласит старая русская пословица, и она вполне справедлива. Не всем книгам надо слепо верить. Некоторые примеры из книг можно смело именовать «пример, как не надо писать код». Не будем углубляться во все тонкости правильного написания кода, об этом можно, и даже нужно, почитать у С. Макконнелла в книге «Совершенный код», а приведем некоторые некачественные примеры из книг.</p>
<h3>Примеры с булевскими переменными</h3>
<p>Очень часто в программе используются CheckBox’ы. Допустим, в настройках программы могут существовать такие настройки, которые можно изменять только при включенном CheckBox’е. В книгах встречается такой код:</p>
<pre class="code">procedure TForm1.CheckBox1Click(Sender: TObject);
begin
  if CheckBox1.Checked then
    GroupBox1.Enabled:=True
  else
    GroupBox1.Enabled:=False;
end;</pre>
<p>Наверное, эти четыре строчки кода лучше заменить одной:</p>
<pre class="code">procedure TForm1.CheckBox1Click(Sender: TObject);
begin
  GroupBox1.Enabled:=CheckBox1.Checked;
end;</pre>
<p>Встречается похожий пример: по нажатию кнопки становится видимой скрытая панель, а при повторном нажатии она прячется:</p>
<pre class="code">procedure TForm1.Button1Click(Sender: TObject);
begin
  if Panel1.Visible then
    Panel1.Visible:=False
  else
    Panel1.Visible:=True;
end;</pre>
<p>Но куда быстрее и красивее написать так:</p>
<pre class="code">procedure TForm1.Button1Click(Sender: TObject);
begin
  Panel1.Visible:=not Panel1.Visible;
end;</pre>
<p>Бывает нужно, чтобы панель появлялась при нажатии на одну кнопку, а скрывалась при нажатии на другую. Обычно пишут две процедуры:</p>
<pre class="code">procedure TForm1.Button1Click(Sender: TObject);
begin
  Panel1.Visible:=True;
end;

procedure TForm1.Button2Click(Sender: TObject);
begin
  Panel1.Visible:=False;
end;</pre>
<p>Но Delphi – Объектно-Ориентированный Язык, так почему же не воспользоваться всеми прелестями ООП? Если посмотреть на заголовок процедуры, можно увидеть, что ей в качестве параметра передается Sender типа TObject. TObject – это базовый класс, от которого унаследованы все другие классы. Sender – объект, вызывающий процедуру. То есть, внутри процедуры можно определить, кто её вызвал. Проведем эксперимент. Разместим на форме две кнопки (Button1 и Button2) и для первой напишем такой код:</p>
<pre class="code">procedure TForm1.Button1Click(Sender: TObject);
begin
  ShowMessage((Sender as TButton).Name); //Приведение Sender к классу
  //TButton и вывод имени экземпляра, который вызвал процедуру.
end;</pre>
<p>Скомпилируем проект и кликнем на кнопку. Появится сообщение с текстом: «Button1». Закроем окно и Event’у второй кнопки присвоим ту же процедуру Button1Click. Вновь скомпилируем проект. Теперь при нажатии на первую кнопку появляется все то же сообщение «Button1», а при нажатии на вторую – «Button2». Теперь понятно, как заменить две процедуры показа/скрытия панели одной:</p>
<pre class="code">procedure TForm1.Button1Click(Sender: TObject);
begin
  Panel1.Visible:= (Sender as TButton).Name=’Button1’;
end;</pre>
<h3>Заключение</h3>
<p>Здесь рассмотрена мизерная часть того, что хотелось. Поэтому ожидайте новых статей (нумерация разделов будет сохраняться), в которых будут рассматриваться все новые и новые «секреты» и интересные модули.
</p>';
	break;

//-------------------------------------------------------------------------------------------------------

case '1009/linekorn.html':
	$site['page']['title'] .= ' - О феномене ложных корней систем линейных алгебраических уравнений при решении в действительных числах';
	$site['page']['description'] .= ' О феномене ложных корней систем линейных алгебраических уравнений при решении в действительных числах';
	$site['page']['keywords'] .= ', ложных корней систем линейных, алгебраических уравнений, уравнений при решении в действительных, ложных корней уравнений';
	$site['page']['body'] .= '<h1>О феномене ложных корней систем линейных алгебраических уравнений при решении в действительных числах</h1>
<b>Автор:</b> <i>Черный Евгений</i>, Николаев, НКИ, апрель 2008.</noindex>
<h1>Тезисы</h1>
<p><b>1. При решении больших или плохо обусловленных систем уравнений часто возникает ситуация, когда прямая подстановка корней в уравнения дает прекрасную невязку для левых и правых частей, а на самом деле вместо ожидаемых корней получается чепуха.</b> Покажем это на примере матрицы Гильберта 13*13, принцип формирования которой понятен из примера 3*3:</p>
<p><center>(1/1)*X<sub><small>1</small></sub> + (1/2)*X<sub><small>2</small></sub> + (1/3)*X<sub><small>3</small></sub> = (1/1+1/2+1/3)<br>
(1/2)*X<sub><small>1</small></sub> + (1/3)*X<sub><small>2</small></sub> + (1/4)*X<sub><small>3</small></sub> = (1/2+1/3+1/4)<br>
(1/3)*X<sub><small>1</small></sub> + (1/4)*X<sub><small>2</small></sub> + (1/5)*X<sub><small>3</small></sub> = (1/3+1/4+1/5)</center></p>
<p>Хотя решение и очевидно (X<sub><small>1</small></sub>=X<sub><small>2</small></sub>=…=X<sub><small>n</small></sub>=1), компьютер с ним не справится. Решая систему при двойной точности вычислений (Double, 15 десятичных разрядов), получим вместо единиц вектор неизвестных, показанный в таблице.<br>
Применительно к задачам строительной механики корабля, матрица, похожая на матрицу Гильберта, получится, если первую силу приложить в центре пролета балки, вторую в центре между местом приложения первой и любой из опор, третью в центре между местом приложения второй и опорой и т.д. Кроме этого, под каждой из сил необходимо поместить упругую опору или перекрестную балку. Сама по себе задача расчета балки на регулярных упругих опорах является «плохой» в вычислительном плане из-за разностей близких величин. И она «ухудшается» многократно, если эти опоры нерегулярны и учащаются по мере приближения к крайней опоре. В то же время матрица Гильберта может быть задана абсолютно точно, поскольку выражается отношением целых чисел. Поэтому ее применяют для самого ответственного тестирования вычислительных программ.</p>
<center><table width="600" cellpadding="3" cellspacing="0" border="1">
<tr><th>Номер корня</th><th>Корень</th><th>Относительная невязка левой и правой частей.</th></tr>
<tr><td>01</td><td>0,9999</td><td>0,0000000000000001</td></tr>
<tr><td>02</td><td>1,0000</td><td>0,0000000000000000</td></tr>
<tr><td>03</td><td>0,9995</td><td>0,0000000000000002</td></tr>
<tr><td>04</td><td>1,0085</td><td>0,0000000000000003</td></tr>
<tr><td>05</td><td>0,9237</td><td>0,0000000000000002</td></tr>
<tr><td>06</td><td>1,4136</td><td>0,0000000000000000</td></tr>
<tr><td>07</td><td>-0,4434</td><td>0,0000000000000002</td></tr>
<tr><td>08</td><td>4,3497</td><td>0,0000000000000000</td></tr>
<tr><td>09</td><td>-4,2224</td><td>0,0000000000000001</td></tr>
<tr><td>10</td><td>6,4052</td><td>0,0000000000000000</td></tr>
<tr><td>11</td><td>-2,5612</td><td>0,0000000000000001</td></tr>
<tr><td>12</td><td>2,3517</td><td>0,0000000000000000</td></tr>
<tr><td>13</td><td>0,7750</td><td>0,0000000000000000</td></tr>
</table></center>
<p>Из таблицы видно, что строка с наиболее неудачным корнем дает нулевую невязку. Этот феномен хорошо известен специалистам, но плохо освещен в литературе. Нет прямых методов оценки погрешностей корней для диагностики "расхождения" решений при вполне удовлетворительных невязках. Все косвенные методы построены на анализе влияния "малых" возмущений правых частей или коэффициентов системы на изменение корней. Если "малые" возмущения приводят к "большим" изменениям корней, то ситуация признается "плохой".<br>
Нет необходимости пояснять, что указанная диагностика напоминает настройку музыкального инструмента "на слух" мастера. А если вы еще не мастер, но уже понимаете, что прямая подстановка корней в уравнения не дает никаких гарантий их истинности? Тогда подойдет способ прямой проверки погрешностей корней, который так прост, что приходится удивляться, почему он не был открыт до сих пор. Этот метод получил название метода <i>единичных корней</i>.</p><br>
<p><b>2. Метод основывается на двух важных свойствах системы уравнений:</b><br>
а) матрица коэффициентов имеет фундаментальные внутренние качества, не зависящие от значений правых частей, например, детерминант. Из этого следует, что если матрица "плохая", то она будет оставаться таковой для любых правых частей;<br>
б) правые части, вычисленные для единичных корней, будут самыми точными из всех возможных ситуаций, поскольку умножение коэффициента системы на единицу не вносит никаких вычислительных погрешностей. Вычислив правые части, приступаем к решению и сравниваем потом полученные корни с единицей.<br>
Хотя метод и прост, основывается он на неочевидных предположениях и требует серьезных размышлений. Именно простота метода рождает у читателя множество вопросов. Например, где гарантия, что он подойдет для конкретной задачи, где по физическому смыслу истинные корни должны быть разными? Но дело в том, что единичные корни не претендуют на роль «истинных» для физической задачи, их назначение – контроль правильности решения матрицы коэффициентов. Для этого необходимо идеальное соответствие правых и левых частей, достичь которого наиболее просто при единичных корнях. Более подробные доказательства приведены в основной работе [1].<br>
Еще одно замечательное свойство единичных корней состоит в том, что они показывают нижнюю границу вычислительных погрешностей по каждому из корней. Это значит, что погрешности истинных корней для «физических» правых частей всегда будут хуже. Но насколько хуже? Показать теоретически то, что если единичный корень неверен в третьей значащей цифре, то примерно такая же погрешность и у «физического» корня, сложно. Зато очевидно, что если у единичного корня нет ни одной верной значащей цифры, то это же утверждение заведомо применимо к любому другому корню.<br>
<br>
<b>3. Что делать в том случае, если единичные корни показывают неудовлетворительные вычислительные погрешности?</b> Ответ прост: независимо от того, насколько верны исходные данные, необходимо именно для них показать соответствующие корни, не выходя при этом за пределы установленных вычислительных погрешностей. Именно вычислительных, пока они не будут устранены, не может быть серьезных претензий ни к физической постановке задачи, ни к точности задания исходных данных. Это можно сделать, только повышая разрядность вычислений, другого пути нет. Как это осуществить практически? Есть специальные математические приложения, MathCAD, например. Есть специальные математические пакеты (профессиональные и нет) для языков программирования.<br>
К сожалению, воспользоваться профессиональным пакетом автор не смог, так как не нашел бесплатного, с исходными кодами и с комментариями русском языке. Переходить в другую среду программирования (MathCAD) неудобно. Пришлось создать свой собственный пакет. Он уступает профессиональным по всем параметрам, зато бесплатный, с исходными кодами и с подробными комментариями. Написан он на языке Паскаль, его работа показана и проверена на примере решения системы уравнений.<br>
<br>
<b>4. Особенности обработки чисел современными процессорами таковы, что мантиссы чисел с повышенной разрядностью («длинных чисел») удобно представлять 32-х разрядными порциями.</b> Результат расчета для 64-х битного числа (двойная точность, double) показан выше, среди корней есть настолько неудачные, что не содержат ни одной верной значащей цифры. Попробуем повторить расчет для числа из 96 бит. В этом случае получим единичные корни, верные до 10-ти первых значащих цифр.<br>
В связи с этими результатами возникает вопрос, нет ли здесь расхождений с рекомендациями Лапласа, дополненных академиком А.Н. Крыловым [2]. Если говорить о точности корней с точки зрения вычислительного процесса, то нет. Что же касается физического содержания результата, то он, безусловно, не может быть «точнее» исходных данных. Как далеко можно заходить в длинных числах, предназначенных для расчета, при фиксированной длине исходных данных?<br>
Решая систему для матрицы Гильберта 200*200, с точностью в 32*32 бит (приблизительно 308 десятичных разрядов) получаются верными 5 первых значащих цифр корней. Это притом, что длина чисел для расчета примерно в 16 раз превосходит длину исходных данных, которые для этого примера определены стандартом в 80 бит (extended). И это далеко не предел, если речь идет только о вычислительных погрешностях. Если задать точность в 32*33 бита, то верны 16 первых значащих цифр корней. Когда же наступает предел, ведь точность расчета нельзя повышать бесконечно при фиксированной точности исходных данных? Это можно установить только экспериментально, и одним из проявлений предела, может служить факт вырождения системы для высоких порядков матриц. Разумеется, что система не должна физически вырождаться ни при каких порядках матриц.<br>
<br>
<b>5. В основной работе приведена статья в полном объеме и три программы на Паскале (Delphi)</b>. В первой программе (приложение 1) осуществляется диагностика вычислительных погрешностей на примере матрицы Гильберта. Во второй и третьей реализован способ снижения погрешностей за счет привлечения арифметики длинных чисел. В приложении 2 реализована условно-десятичная арифметика, а в приложении 3 – двоичная. Это не одно и тоже, если речь идет о вычислениях с действительными числами, где постоянно приходится усекать мантиссу, округляя последнюю значащую цифру.</p>
<br>
<p>Полный объем работы с учетом трех программ в исходных кодах равен примерно 3500 строк. Поэтому здесь излагаются только основные положения, а электронную копию полного документа все заинтересованные читатели получат, обратившись к автору с письмом по адресу BLACK_EN@MAIL.RU.</p>
<br>
<p>( <a href="'. $site['setting']['base'] .'/img/num/09/06/1.zip">Основная работа,</a> 53 страницы + программа в исходных кодах на Паскале (Delphi), 151кб )</p>';
	break;

//-------------------------------------------------------------------------------------------------------

case '1009/tech_lang.html':
	$site['page']['title'] .= ' - Научно-технический язык';
	$site['page']['description'] .= ' Научно-технический язык';
	$site['page']['body'] .= '<h1>Научно-технический язык</h1>
<b>Автор:</b> <noindex><a href="http://forum.sources.ru/index.php?showuser=4949" rel="nofollow" target="_blank"><i>vk</i></a></noindex>
<p>Сегодня я расскажу вам о том, как следует писать статьи… Стоп-стоп-стоп! Никогда не начинайте свое повествование так. Здесь целых три грубых ошибки. Во-первых, начало статьи (справки, рассказа, да чего угодно) должно содержать если не аннотацию, то хотя бы введение, нечто воздушно-неопределенное, настраивающее читающего на определенный стиль восприятия текста. Во введении обычно говорят кратко о состоянии дел в рассматриваемой области, о том, какие есть проблемы в ней, а также о том, почему нижеследующий текст будет полезен читателю. И только потом приступают к изложению материала. Во-вторых, научно-технический стиль (а также научно-популярный и публицистический), в отличие от стиля литературного, предполагает безличность. Нежелательно употреблять даже местоимения «Вы» и «Мы», не говоря уже о самонадеянном «Я». А в-третьих, даже самые уважаемые профессора в самые уважаемые журналы не пишут статьи от лица всезнающего гуру. А если и пишут, то таких профессоров в научном мире не любят. Попробуем начать заново…</p>
<p>Современное общество предполагает постоянный обмен информацией. В мире живет и работает множество умных, образованных специалистов, мастеров своего дела. В определенный момент знаниям и опыту становится тесно в сознании хозяина, и у последнего возникает потребность написать статью. Или книгу. Или справочную систему. Или отчет о проделанной работе. Или диплом. Или диссертацию. К сожалению, самую лучшую идею, самую новую теорию и самый понятный материал можно неузнаваемо испортить, преобразовав в текст. Информация, проходя через фильтры бытовых мыслей, эмоций, характера пишущего, не может не измениться, поэтому текст, появившийся на бумаге, всегда будет искажать идеи автора. Это первая половина проблемы, вторая – наличие читателей, каждый из которых имеет свой характер, свои эмоции, свои внутренние установки. Прочитав один и тот же текст, N человек получат N различных представлений о предмете рассмотрения. Искажения обусловлены структурой сознания человека. От них нельзя избавиться совсем, но можно значительно уменьшить, применяя определенные общепринятые правила формирования научно-технического текста.</p>
<h3>Стиль и содержание научно-технического текста</h3>
<p>Разговорный, литературный, публицистический языки имеют множество функций: эмоциональная, эстетическая, пропагандистская, императивная, информационная. Для научно-технического языка это множество функций сокращается до одной. <b>Информационной</b>. Научно-технический язык предназначен для передачи объективной информации о природе, технике, человеке и обществе. Отсюда следует, что из научно-технического текста должны быть безжалостно изгнаны все апелляции к эмоциям, эстетике, чувству долга и т.д. Не стоит, описывая принципы структурного программирования, усиливать свои предложения восклицательными знаками, ехидными вопросами, радостными «Получилось!». Нежелательно украшать статью о паттернах в Java даже самым красивым стихотворением о ссылочных типах. Нет-нет, это совсем не значит, что научно-технические тексты должны напоминать лекции из старого учебника по высшей математике. Весь свой искрометный юмор, научное остроумие и эстетические потребности автор может реализовать и в научном тексте. В эпиграфах и рисунках. Используйте в эпиграфах к статье, к её разделам и подзаголовкам подходящие высказывания Козьмы Пруткова и Ходжи Насреддина, стихи Басе и строчки из песен Высоцкого. Если богатый духовный мир автора и после внедрения эпиграфов не дает покоя и просится в реализацию – украшайте схемы наилучшего с точки зрения эргономики расположения терминалов забавными рожицами операторов, а если на рисунке присутствует изображение компьютера, не поленитесь пририсовать к нему мышь на коврике и пингвина на мониторе. Разумеется, и при этом желательно обладать чувством меры.</p>
<div class="rule"><p>Правило 1. Не расширяйте функциональность научно-технического текста эмоциями, пропагандой, эстетикой. Единственная функция научно-технического текста – передача информации.</p></div>
<p>Научно-технические тексты ориентированы на применение в соответствующих научно-технических сообществах. Отсюда вытекает необходимость изъясняться именно в том <b>терминологическом пространстве</b>, в котором принято изъясняться в <b>целевой аудитории</b>. Создавая для журнала «Новости психиатрии» статью о психологической мотивации подростка, выявляющейся тестом Серегина-Флокса, не следует разъяснять, что такое «мотивация» и «пубертатный период». А в статье об основах языка ассемблер для начинающих, наоборот, обязательно нужно объяснить каждый введенный термин. Начинающий ассемблерщик не обязан знать, что такое «регистр» и какие флаги состояний можно использовать, тогда как состоявшийся психиатр непременно в курсе основных особенностей подростковой психологии. Здесь же следует отметить, что для научно-технических текстов действует одно простое правило: чем ниже уровень знаний целевой аудитории, тем больше в тексте должно присутствовать иллюстраций, примеров, пояснений, а также исторических сведений о предмете рассмотрения.</p>
<div class="rule"><p>Правило 2. Ориентируйте научно-технический текст точно на тот уровень знаний, которым должна обладать целевая аудитория.</p></div>
<p>Очень важно, чтобы читатель и автор понимали использованные в тексте термины одинаково. Следует помнить, что множество терминов предметной области всегда содержит подмножество не требующих объяснения для специалиста. Например, «линейное уравнение», «базис циклов», «множество Парето». Такие термины (при условии, конечно, соответствующего уровня целевой аудитории) можно использовать как угодно часто, наравне со словами из словаря общей лексики. Но в любой предметной области существуют термины, которые адресат и автор могут понимать по-разному: «векторная идентификация», «распознавание образов», «искусственный интеллект». С такими терминами следует обращаться осторожно. Вводя такой термин в текст, необходимо пояснить его сущность, например, так: «… применяется символьный вывод. Под символьным выводом здесь понимается …». Или так: «… с помощью функции полезности. В качестве функции полезности возьмем …»</p>
<div class="rule"><p>Правило 3. Читатель должен понимать все использованные в тексте термины именно так, как их по-нимает автор. Обеспечьте прозрачность терминов</p></div>
<p>Объективность передаваемой информации достигается выполнением требований <b>последовательности</b> изложения, <b>отвлеченности и отстраненности. Последовательность</b> заключается в строгой очередности вводимых понятий. Все знают, что если в тексте программы обратиться к переменной, объявленной позже, компилятор выдаст ошибку. Но при этом некоторые авторы не считают зазорным пользоваться в начале текста терминами, определение которых дается где-нибудь в последнем разделе. Трудно читать текст, который начинается с описания преимуществ нового метода решения дифференциальных уравнений перед старым, если суть этого нового метода объяснена на следующей странице. Определить очередность появления понятий можно старым проверенным способом:</p>
<ul>
<li>Составляется граф, в котором вершин будет столько, сколько понятий в тексте.</li>
<li>Для каждой пары понятий А и В проводится дуга А?В если для объяснения А необходимо знание В.</li>
<li>Граф ранжируется, в результате чего определяется необходимая очередность появления по-нятий. Ранжирование заключается в нахождении последовательности уровней (групп понятий), причем внутри каждого уровня нет дуг, а дуги между уровнями направлены только в одну сторону. Сначала должны быть введены понятия первого уровня, затем второго и так далее.</li>
</ul>
<div class="rule"><p>Правило 4. Материал излагается последовательно. Не забегайте вперед, не возвращайтесь к уже из-ложенному. Структурируйте текст.</p></div>
<p><b>Отвлеченность</b> состоит в том, что описываются <b>сущности</b>, а не явления. Классы, а не объекты, если угодно. Другое дело, что в разных текстах уровень абстрактности сущности может быть различным. В статье о новом лекарстве против диабета нужно оперировать симптомами, причинами, фармацевтиче-скими особенностями и действием препаратов. Такую статью нельзя строить на двух конкретных случаях исцеления. Необходимо, но не достаточно отследить динамику множества больных, привести статистику, помимо этого обязателен анализ ситуации на уровне сущностей. Статья об объектно-ориентированном программировании немыслима без качественных примеров, но не может состоять только из них. Уровень сущностей для такой статьи – это принципы ООП, правила проектирования и программирования.</p>
<div class="rule"><p>Правило 5. Излагайте материал отвлеченно от явлений. Явления могут демонстрировать описанные сущности как примеры, но не могут быть основой научно-технического текста</p></div>
<p><b>Отстраненность</b> научно-технического текста в личной незаинтересованности автора. Очень некрасиво писать научную статью о преимуществах использования теории мультимножеств только ради того, чтобы в конце упомянуть о существовании разработанной автором программной системы, реализующей все вышеописанное, которая стоит столько-то, и приобрести которую можно там-то.</p>
<div class="rule"><p>Правило 6. Будьте беспристрастны и незаинтересованны. Текст должен быть объективным</p></div>
<h3>Грамматика и синтаксис научно-технического текста</h3>
<div class="rule"><p>Правило 7. Пишите грамотно.</p></div>
<p><b>Грамотность</b> научно-технических текстов необходима. Это не подлежит обсуждению. Диплом, курсовой, отчет, написанный с ошибками, вызывает в лучшем случае смех, в худшем – пересдачу, но никогда – уважение к автору и изложенной идее. Статью, диссертацию, книгу, конечно, можно отнести на коррекцию. Но никакой корректор не в состоянии изучить терминологию всех текстов, над которыми работает. В результате – бытовые слова и предложения будут безупречны, а над «эргадичностью системы» будет долго потешаться вся целевая аудитория.<br>
Грамотность – обязательна. Но даже грамотный текст не произведет впечатления научно-технического, если не будет обладать определенными особенностями использования слов и построения предложений:</p>
<ul>
	<li>Характерен именной <b>характер</b> речи. <b>Существительные</b> преобладают над прилагательными</li>
	<li>Вместо глаголов зачастую используются <b>отглагольные существительные</b> (анализировать ? подвергать анализу, воздействовать ? оказывать воздействие)</li>
	<li>Чаще других используются существительные, оканчивающиеся на «-ие», «-ость», «-тво», «-ка». </li>
	<li>Используются <b>отыменные</b> (сложные) <b>предлоги</b>: «в связи», «в течении», «в отношении» </li>
	<li>Часто используются <b>несовершенные глаголы</b>. Конкретные действия («я решил уравнение») заменяется действием вообще («это уравнение решается») </li>
	<li>Форма <b>будущего времени</b> используется не только для обозначения действий в будущем, но и в настоящем («проведем исследование», «уравнение примет вид») </li>
	<li>Не используются <b>местоимения</b> второго лица, почти не используются местоимения первого (в крайних случаях допустимо использование «мы»), зато часто встречаются третьего, особенно среднего рода («оно»).</li>
	<li>Признаки выражаются <b>краткими причастиями</b> («клетки <i>бедны</i> протоплазмой»)</li>
	<li><b>Предложение</b> отличается структурной полнотой, ярко выраженной союзной связью и разнообразием подчинительных связей. Предложения сложны в конструкции и обладают завершенностью мысли.</li>
	<li>Преобладают <b>сложноподчиненные</b> предложения, причем характер подчинения в большинстве случаев причинно-следственный («так что», «если…то», «тогда… когда», «и поэтому», «следовательно»). Кстати, надо иметь в виду, что в русском языке нет союзов «когда…то» и «если… тогда», которыми любят злоупотреблять как студенты, так и специалисты.</li>
	<li>Сложносочиненные и бессоюзные предложения не характерны, но допустимы, если нужно подчеркнуть важность некоторой мысли или резюмировать вышесказанное.</li>
	<li>Употребляются <b>неопределенно-личные предложени</b>я («медь добывают в Сибири»)</li>
	<li>Часто главную часть предложения делают совершенно неинформативной, а всю смысловую нагрузку передают придаточной («Известно, что вода кипит при 100 градусах»). Эти общепринятые речевые клише («известно, что…», «доказано, что», «не требует доказательств утверждение о том, что») составляют метатекст, формирующий структуру изложения.</li>
	<li>В основном характерен <b>прямой порядок</b> слов (подлежащее перед сказуемым). Инверсия порядка служит специальным целям («… а реализует данный метод следующий алгоритм»).</li>
	<li>Текст должен быть правильно поделен на <b>абзацы</b>. Каждый абзац посвящается одной микротеме и состоит минимум из двух предложений.</li>
</ul>
<div class="rule"><p>Правило 8. При создании научно-технического текста следует обращать внимание не только на содержание и грамотность, но и на частоту применения различных частей речи, способ формирования предложений и разбиения текста на абзацы.</p></div>
<h3>«Отладка» научно-технического текста</h3>
<p>Создание текста в соответствии со всеми перечисленными канонами и интереснейшее содержание не являются гарантией того, что целевая аудитория примет текст. Необходимо следить за грамотностью текста и обеспечивать его строгую и красивую структуру, но, как ни странно, немалое значение в восприятии текста имеет его фонетика. «Неэстетично» звучащий текст будет трудно читать. Нельзя использовать сочетания труднопроизносимых согласных, фонетически некорректны длинные последовательности гласных. Чтобы добиться фонетической «эстетичности» текста, нужно прочитать вслух окончательный вариант и исправить все сочетания звуков, которые вызывают внутренний дискомфорт.</p>
<div class="rule"><p>Правило 9. Прочитайте результат вслух с выражением и исправьте все фонетические ошибки. Текст должен звучать красиво.</p></div>
<div class="rule"><p>Правило 10. Готовый текст отложите и не возвращайтесь к нему два-три дня. По истечении указанного срока перечитайте его как чужой. Исправьте все, что вызывает сомнение.</p></div>
<p>Последнее правило давно известно и применяется не только к научно-техническим текстам. Им руководствуются и ученые, и журналисты, и писатели. В процессе чтения попытайтесь представить себе, что являетесь одним из потенциальных читателей и видите текст первый раз в жизни. При наличии воображения это несложно. После окончательной редакции к тексту возвращаться не стоит, иначе процесс отладки затянется надолго. Экспериментальным путем установлено, что наибольшее количество неточностей выявляет первая «<b>отложенная вычитка</b>», а все остальные занимают гораздо больше времени, чем приносят пользы.</p>
<p>Научно-технический язык выполняет всего одну функцию – передача информации. Но эта функция обладает такой мощностью, какой никогда не смогут достичь ни публицистический, ни художественный, ни бытовой язык. Задача автора научно-технического текста не только в выражении своих идей на бумаге, но и в донесении их до читателя. Необходимо придать тексту и содержание, и форму.</p>
<h3>Приложение. Структура и оформление научно-технического текста</h3>
<h4>1. Заголовок</h4>
<p>Должен адекватно именовать текст. Название не должно быть излишне общим (текст должен рассматривать все заявленное в названии) и излишне частным (в тексте не должно быть ничего сверх заявленного в названии)</p>
<h4>2. Аннотация</h4>
<p>Обязательна не для всех научно-технических текстов. Кратко описывает содержание текста. По аннотации потенциальный читатель делает для себя вывод о необходимости чтения текста.</p>
<h4>3. Введение</h4>
<h4>4. Текст, структурированный по разделам и (если необходимо) подразделам</h4>
<ul>
	<li>Обоснование <b>актуальности</b> проблемы (почему об этом надо писать?)</li>
	<li><b>Историография</b> вопроса (как это было раньше?)</li>
	<li><b>Постановка</b> проблемы (о чем будет разговор?)</li>
	<li><b>Рассмотрение</b> проблемы (в чем суть?)</li>
	<li><b>Вывод</b> (и что теперь?)</li>
</ul>
<h4>5. Заключение</h4>
<h4>6. Библиография (список литературы)</h4>
<p>В последнее время к оформлению библиографии предъявляются не очень строгие требования. Главное, чтобы источники были пронумерованы в порядке появления ссылок в тексте, и для каждого указывались авторы, название, издательство и год издания. Для статей сверх перечисленного необходимо указать название журнала и номер выпуска.</p>
<p>Все иллюстрации, таблицы и листинги должны быть поименованы, пронумерованы и оформлены единообразно в пределах статьи. Например:</p>
<p><center><img src="'. $site['setting']['base'] .'/img/num/09/07/1.png" width="179" height="56" alt="Научно-технический язык"><br>
Рис. 1 – Воздушный шарик</center></p>
<p>Таблица 1. Характеристика воздушного шарика</p>
<center><table width="600" border="1" cellspacing="0" cellpadding="5">
	<tr><th>Цвет</th><th>Диаметр, см</th><th>Цена, р</th></tr>
	<tr><td>белый</td><td>30</td><td>25</td></tr>
</table></center>
<p>В тексте должны быть ссылки на рисунки (см. рис. 1), таблицы (см. табл. 1), листинги и библиографию [1].</p>
<h4>Список литературы</h4>
<p>1.	В.Н. Маглыш «Научный стиль», С-Пб, издательство ПГУПС, 2001</p>';
	break;

//-------------------------------------------------------------------------------------------------------

case '1009/Symfony.html':
	$site['page']['title'] .= ' - Введение в PHP фреймворки. Symfony';
	$site['page']['description'] .= ' Введение в PHP фреймворки, Symfony';
	$site['page']['keywords'] .= ', Введение PHP фреймворки, Введение Symfony, фреймворк симфони, фреймворк Symfony';
	$site['page']['body'] .= '<h1>Введение в PHP фреймворки. Symfony</h1>
<b>Автор:</b> <noindex><a href="http://forum.sources.ru/index.php?showuser=21602" rel="nofollow" target="_blank"><i>osa</i></a></noindex>
<p>Определение:<br>
<i>Программный фреймворк (англ. software framework) — каркас программной системы (или подсистемы). Может включать вспомогательные программы, библиотеки кода, язык сценариев и другое ПО, облегчающее разработку и объединение разных компонентов большого программного проекта. Обычно объединение происходит за счёт использования единого API</i>.</p>
<p>При выборе инструмента для разработки больших бизнес проектов программисты часто используют готовые решения. Одним из таких готовых решений является фреймворк Symfony <noindex>(<a href="http://www.symfony-project.org" rel="nofollow">http://www.symfony-project.org/</a>)</noindex>. Он свободно распространяется и использует паттерн Model-View-Controller (MVC).</p>
<p>Определение:<br>
<i><b>Model-view-controller</b> (MVC, «Модель-представление-поведение», «Модель-представление-контроллер») — архитектура программного обеспечения, в которой модель данных приложения, пользовательский интерфейс и управляющая логика разделены на три отдельных компонента так, что модификация одного из компонентов оказывает минимальное воздействие на другие.</i></p>
<p>Разработчики предоставляют несколько способов установки продукта. Самый оптимальный, по-моему, способ – установка при помощи PEAR.<br>
Определение:<br>
<i>PEAR (акроним от английских слов PHP Extension and Application Repository) — это библиотека классов PHP с открытым исходным кодом. В стандартную поставку PHP входит система управления классами PEAR, которая позволяет легко скачивать и обновлять их.</i></p>
Для установки Symfony с помощью PEAR необходимо:<br>
<ul>
<li>открыть канал<br>
<pre>$ pear channel-discover pear.symfony-project.com</pre></li>
<li>начать установку<br>
<pre>$ pear install symfony/symfony-x.x.x</pre></li>
<li>запомнить предложенный путь установки Symfony.</li>
</ul><br>
После окончания установки фреймворка можно приступать к созданию проекта. Для этого нужно создать каталог, в котором будет храниться проект, перейти в него и запустить генератор проекта<br>
<pre>$ php lib/vendor/symfony/data/bin/symfony generate:project PROJECT_NAME</pre><br>
После этого в корневом каталоге проекта появятся следующие подкаталоги:<br>
<b>apps/</b> Все приложения проекта<br>
<b>cache/</b> 	Кеш фреймворка<br>
<b>config/</b> Файлы настроек проекта<br>
<b>lib/</b> 	Библиотеки и классы проекта<br>
<b>log/</b> 	Лог фреймворка<br>
<b>plugins/</b> Установленные плагины<br>
<b>test/</b> 	Юнит и функциональные тесты<br>
<b>web/</b> 	Каталог веб-сервера<br>
<br>
Для создания первого приложения, отвечающего за интерфейс проекта, необходимо, находясь в каталоге проекта, выполнить следующую инструкцию:<br>
<pre>$ php symfony generate:app --escaping-strategy=on --csrf-secret=UniqueSecret frontend</pre><br>
При успешном выполнении в каталоге apps/ появились следующие подкаталоги:<br>
<b>config/</b> Файлы настроек приложения<br>
<b>lib/</b> 	 Библиотеки и классы приложения<br>
<b>modules/</b> 	Код приложения (MVC)<br>
<b>templates/</b> 	Глобальные файлы-шаблоны<br>
После этого проект можно просматривать через браузер, для чего в адресной строке необходимо указать URL проекта. Если все было сделано правильно, браузер покажет стартовую страницу приветствия «Symfony Project Created».<br>
В следующем выпуске журнала будет рассказано о создании модулей и настройке баз данных.<br>
Существует множество примеров проектов, написанных с использованием Symfony, с ними можно ознакомиться на сайте <noindex><a href="http://symfonians.net/applications" rel="nofollow">http://symfonians.net/applications</a></noindex>.</p>';
	break;

//-------------------------------------------------------------------------------------------------------

case '1009/open_source.html':
	$site['page']['title'] .= ' - Мир Open source';
	$site['page']['description'] .= ' Мир Open source';
	$site['page']['keywords'] .= ', Мир Open source';
	$site['page']['body'] .= '<h1>Мир Open source</h1>
<b>Автор:</b> <noindex><a href="http://forum.sources.ru/index.php?showuser=21602" rel="nofollow" target="_blank"><i>osa</i></a></noindex>
<p>В мире высоких технологий каждый программист сталкивается с проблемой выбора инструмента. Инструмента, который будет приносить ему деньги. Да, именно деньги. Давайте поговорим о людях, которые зарабатывают деньги, используя Open source продукты.</p>
<p>Wikipedia дает следующее определение Open source:</p>
<p><i>Открытое программное обеспечение, то есть программное обеспечение с «открытым» исходным кодом (англ. open source software) — способ разработки ПО, при котором исходный код создаваемых программ открыт, то есть общедоступен для просмотра и изменения. Это позволяет всем желающим использовать уже созданный код для своих нужд и, возможно, помочь в разработке открытой программы</i>.</p>
<p>На первый взгляд, все хорошо: программист получает готовую программу или библиотеку, да еще и с открытым кодом, в котором все можно подправить.</p>
<p>Но с этого момента он попадает в матрицу, в матрицу Open source, в которой тоже есть две таблетки:</p>
<p>1) Очень часто оно работает не так, как надо.</p>
<p>2) Нет документации к коду. А кода так много, что исправлять опускаются руки</p>
<p>И обе эти таблетки придется проглотить сразу.</p>
<p>Почему так? Все просто. Программист (или группа программистов) решает создать открытый проект. Мотивация может быть различной, но в основном это:</p>
<p>1) Заработок</p>
<p>2) Реклама себя или фирмы</p>
<p>3) Энтузиазм</p>
<p>Пусть фирма создает проект и хочет на нем заработать. Как вариант, пусть проект сначала создается для рекламы или на чистом энтузиазме, но потом появляется желание заработать.</p>
<p>В этом случае существует большая вероятность, что все заявленные функции будут работать так, как заявлено. Но документации по API проекту все травно будет отсутствовать или будет скудна.</p>
<p>Примеры:</p>
<p>1) cURL —служебная программа командной строки для передачи файлов с синтаксисом URL.</p>
<p>При установки этой системы у автора возникли трудности. Написав в службу поддержки, он получил ответ, что помощь в установке продукта возможна, но час работы стоит 120$, а минимально необходимо оплатить два часа.</p>
<p>2) ExtJS – JavaScript фреймворк. Нехватка документации.</p>
<p>Примеров гораздо больше, но здесь рассмотрены только те, с которыми сталкивался автор лично.</p>
<p>Рассмотрим второй пункт – реклама.</p>
<p>Самым интересным примером являются игры любых направлений, как Web так и 3D-стрелялки.</p>
<p>Многие фирмы берутся делать их, чтобы показать себя миру. Ведь по статистике большинство людей покупает компьютер не для работы, а имено для игры.</p>
<p>Выпускаются сотни бесплатных игровых движков, но взглянем правде в глаза, многие из вас слышали про OpenArena или AlienArena? Нет. Зато все знают, что такое WarCraft, Unreal и т.д. А из этого следует то, что бесплатные движки пока уступают коммерческим. Причины, видимо, те же.</p>
<p>К последнему пункту необходимо подходить с осторожностью. Так как заявить сразу же, что на энтузиазме не получаются или тяжело получаются хорошие продукты, нельзя. Но можно с уверенностью в 99% сказать, что в некоторый момент заказчик начинает хотеть получить от них прибыль. Здесь не следует затрагивать ОС Линукс, т.к. для обсуждения этого вопроса необходима другая большая статья тема, но хотелось бы привести примеры таких продуктов как Drupal и Joomla. Более детально вы можете ознакомиться с ними на <noindex><a href="http://drupal.org" ref="nofollow">drupal.org</a> и <a href="http://joomla.org" ref="nofollow">joomla.org</a></noindex></p>
<p>Эти два продукта являются гигантами в мире Open source PHP CMS. Но что мы видим? Да, ядро сделано красиво, есть большой выбор модулей, но многие модули настолько сыры, что использовать их можно только на свой страх и риск. То, на чем держится вся эта технология – это open sourse сообщества. Они велики и поражают своей масштабностью.</p>
<p>Решать, что использовать, при помощи чего зарабатывать деньги – только вам.</p>
<p>Но следует знать, что один раз войдя в мир Open source, выйти очень тяжело.</p>';
	break;

//-------------------------------------------------------------------------------------------------------

case '1009/cms_drupal.html':
	$site['page']['title'] .= ' - CMS Drupal';
	$site['page']['description'] .= ' Введение в CMS Drupal. Первое знакомство с Drupal, рассмотрение терминологиии и основ системы Drupal.';
	$site['page']['keywords'] .= ', CMS Drupal, начало Drupal, как использовать Drupal, друпал, сделать сайт друпал, сделать сайт Drupal';
	$site['page']['body'] .= '<h1>CMS Drupal</h1>
<b>Автор:</b> <noindex><a href="http://forum.sources.ru/index.php?showuser=9930" rel="nofollow" target="_blank"><i>orb</i></a></noindex>
<p>CMS Drupal каждый день становится все более популярной. Начал разработку Друпала в 2000 году бельгиец Дрис Байтаерт (Dries Buytaert), он и поныне является руководителем проекта. При первом знакомстве эта система не вызывает бурных эмоций, хотя позитивных дает немало. Базовая комплектация позволяет за 5-10 минут создать от простейшего сайта-визитки до полноценного портала с форумом, блогом, голосованиями, подборкой в книги, новостями, статьями, импортом/экспортом RSS, системой поиска, статистикой, группами пользователей, многоязычностью и многим другим. Но после более подробного знакомства с системой оказывается, что все это только вершина айсберга. На следующем шаге знакомства появляется <em>таксономия</em>, именно эта технология в наибольшей мере показывает мощность системы Друпал.</p>
<p><strong>Таксономия</strong> – это набор словарей и терминов для отделения структуры от представления. Рассмотрим пример. Пусть есть следующая задача: на сайте необходимо создать новости из мира спорта (помимо основных новостей). Появляется новый раздел: СПОРТ. Теперь, так как есть много разных видов спорта, нужно соответственно разделить новости для удобства чтения. Выделим несколько ключевых видов спорта: футбол, автоспорт, силовые единоборства – получим 3 рубрики.</p>
<p>Все выше сказанное можно проделать на Друпале с помощью технологии таксономии. Создаются термины «футбол», «автоспорт», «силовые единоборства» и объединяются в один словарь «Спорт». Теперь во время создания любой новости, необходимо будет указывать к какому виду спорта она принадлежит, а читатель сайта, сможет выбирать из базы данных все новости, относящиеся к интересующему его термину.</p>
<p>Таксономия – очень гибкая система, количество словарей может быть огромным, термины могут организовывать иерархию. Любой материал сайта, будь то статья или новость, может быть связана с несколькими терминами, как с одного словаря, так и с нескольких. Если рассматривать дальше пример с новостями спорта, то можно создать еще один словарь с марками автоконцернов: {«БМВ», «Мерседес», «ВАЗ»}. При создании новости из мира автоспорта можно будет указывать, к какой марке относится новость. В результате получатся еще и новости производителей автотехники. На сайте будет размещена ссылка на «Автоспорт» и ссылка на автоконцерны. После выбора пользователем одной из них Друпал сам выберет нужные новости по термину.</p>
<p>Примеры использования таксономии:<br>
<ul>
<li>Меню сайта с разделами и подразделами</li>
<li>Рубрики сайта</li>
<li>Журнал и классификация статей по: номерам журнала, рубрике/рубрикам</li>
<li><a href="http://vseok.org.ua/foto">Фотогалерея</a> с разделением фотографий по теме, местоположению</li>
<li>Облако тегов</li>
<li><a href="http://vseok.org.ua/forum">Форум</a> - не что иное как таксономия. Сам форум - это словарь, разделы и подразделы - термины словаря.</li>
<li><a href="http://vseok.org.ua/vizitka">Бизнес-визитки</a></li>
</ul></p>
<p>Кратко все возможности таксономии описать нереально, но начальное представление о ней дано, на данном этапе этого более чем достаточно.</p>
<p>Разумеется, Друпал популярен не только из-за таксономии, есть еще модули, которые позволяют расширять далеко не бедный функционал этой CMS.</p>
<p>Современные сайты предоставляют далеко не только возможность просто чтения новостей, и Друпал стоит на гребне этой волны. Выбор модулей измеряется тысячами, но главное преимущество в простоте их использования. Установка модуля заключается в скачивании архива и распаковке в нужную папку, после чего модуль активируется в админке и готов к использованию. Перечисление всех модулей займет слишком много страниц и времени, так как их около 7000, а перечисление части может привести к жаркому спору, так как у каждого Друпаллера есть свои любимые, поэтому ограничимся общими словами о пользе модулей Друпала. Модули предназначены для расширения функционала сайта. С помощью модулей можно сделать подписку на новинки, фотогалереи, рейтинги, облако тегов, подключить разные виды редакторов, файловый архив, группы по интересам, антиспам защиты, разнообразные карты сайты и многое другое.</p>
<p>Друпал предоставляет также большой набор готовых тем. Чтобы сменить вид сайта, достаточно скачать одну из них, распаковать и включить, после чего сайт мгновенно приобретает лицо. Количество бесплатных тем достаточно велико и, как и в случае с модулями, все делается в пару кликов мышкой.</p>
<p>Как и любая система, Друпал имеет свои плюсы и свои минусы, а также спорные моменты. Например, Друпал рассчитан на продвинутого пользователя или начинающего программиста. С одной стороны, имеется мастер установки, который не вызовет трудностей даже у начинающих, логичная админка с управлением одними «галочками», а с другой стороны, если делать проект средней сложности, то без РНР и чтения мануалов не обойтись, если важен результат. Часть пользователей недовольна тем, что знание РНР необходимо, а часть считает это барьером от «ламеров» и говорит, что это плюс. В любом случае, есть огромное количество документации на разных языках, поэтому тот, кто подходит к вопросу ответственно, получает хороший результат.</p>
<p>Следующий недостаток заключается в потреблении большого количества ресурсов. Конечно, если создать сайт-визитку на 10 страниц, Друпал будет потреблять намного больше ресурсов, чем HTML+CSS. Хоть часть функционала и отключена, но все же это будет многоязычная система с хорошей системой безопасности, с поиском и статистикой и кучей функционала в самом ядре. Поэтому часть пользователей считает это недостатком, а часть – вполне оправданной платой за функционал. В конце концов, иногда лишняя планка памяти стоит намного дешевле, чем оплата труда программиста, поэтому к экономии ресурсов нужно подходить с умом и оптимизировать только то, что нуждается в оптимизации, а не бороться за каждый байт памяти.</p>
<p>Но все вышесказанное – лишь капля из того, что умеет Друпал, просто рассказать обо всем в одной-двух статьях невозможно. Об этом продукте уже вышло немало книг, и все равно до конца он еще не раскрыт. Здесь рассказано только о тех возможностях, которые управляются из админки, но ни слова не сказано об использовании Друпала программистами, так как это совсем другая история в нескольких частях (чего только стоит наличие нескольких API  в одном ядре).</p>
<p>Перефразируя известное высказывание, резюмирую: <em><strong>чем больше работаешь с Друпалом, тем больше понимаешь, как мало ты о нем знаешь!</strong></em></p>';
	break;

//-------------------------------------------------------------------------------------------------------

case '1009/real_drop_water.html':
	$site['page']['title'] .= ' - Реалистичные капли воды';
	$site['page']['description'] .= ' Реалистичные капли воды. Урок с обучает как с помощью программы photoshop нарисовать каплю воды';
	$site['page']['keywords'] .= ', Реалистичные капли воды, урок фотошопа вода, урок photoshop вода, как нарисовать воду, как нарисовать каплю';
	$site['page']['body'] .= '<h1>Реалистичные капли воды</h1>
<b>Перевод:</b> <noindex><a href="http://forum.sources.ru/index.php?showuser=21250" rel="nofollow" target="_blank"><i>winny</i></a></noindex>
<p>Имея хорошую цифровую камеру, твердую руку и острый глаз, можно получить захватывающие фотографии красот природы. Но что делать, если подходящую сцену для фотографирования найти очень сложно, а найденное неинтересно или некрасиво? В этом случае на помощь приходит Photoshop и другие средства обработки изображений. Ниже описывается простой метод создания в Photoshop реалистичной капли воды, которую можно добавить к любому изображению.</p>
<table class="table_text">
<tr><td><img src="'. $site['setting']['base'] .'/img/num/09/11/1.jpg" width="300" height="182" alt="Реалистичные капли воды"></td>
<td><strong>Шаг 1</strong>: Откройте любое изображение в Photoshop. Лучше каплю делать там, где она могла бы быть на самом деле. Капля, например, на газете, выглядит неправдоподобно.<br>
Сделайте выделение в форме капли, используя Выделение эллипсом.  Можно повернуть выбранную область, используя <strong>Контекстное меню -> Преобразовать выделение</strong>, если есть такая необходимость</td></tr>
<tr>
<td><img src="'. $site['setting']['base'] .'/img/num/09/11/2.jpg" width="300" height="300" alt="Реалистичные капли воды"></td>
<td><b>Шаг 2</b>: Нажмите CTRL+J для преобразования выбранной области в слой. Назовите его (например, <i>droplet</i>). Найдите новый слой на палитре слоев, и, зажимая CTRL, выберите его. Вокруг капли должен появиться эллипс. После этого запускайте <b>Filter -> Distort -> Spherize</b> (<b>Фильтр -> Distort -> Spherize</b>), и изменяйте параметры. Этот фильтр воссоздает основу оптического искажения капли воды.<br>
Сделайте слой <i>droplet</i> текущим, выберите команду <b>Layer -> Layer Style -> Drop Shadow (Слой -> Стиль слоя -> Падающие тени)</b> из главного меню и введите параметры, указанные на рисунке слева.</td>
</tr>
<tr>
<td><img src="'. $site['setting']['base'] .'/img/num/09/11/3.jpg" width="300" height="276" alt="Реалистичные капли воды"></td>
<td><b>Шаг 3</b>: Не нажимая кнопку OK, запустите меню <b>«Внутренние тени»</b> (<b>Inner shadow</b>) и введите параметры, показанные на рисунке слева. Обратите внимание на то, что <b>Angle (Угол)</b> эффекта должен быть изменен так, чтобы отражать положение источника света в композиции. В рассматриваемом примере свет идет сверху справа, но на других фотографиях он может быть в другом месте. По достижении приемлемого результата нажмите OK.
<br><br>
<b>ВНИМАНИЕ:</b> <i>Эти установки и методы дают хороший результат только для капли простой формы. Если нужно сделать каплю более сложной формы, можно отказаться от Spherize и уменьшить параметр Fill Opacity (мутноватость) до 0%.</i></td>
</tr>
<tr>
<td><img src="'. $site['setting']['base'] .'/img/num/09/11/4.jpg" width="300" height="182" alt="Реалистичные капли воды"></td>
<td><b>Шаг 4</b>: Если выделение еще активно, уберите его. Выберите <b>Blur Tool (смазывание)</b> с кистью среднего размера и интенсивностью 50%, смажьте левый нижний угол капли (угол, противоположный источнику света). У настоящих капель воды нет, конечно же, острых углов, и это косметическое улучшение поможет сильно увеличить реализм капли, особенно если она маленького размера.</td>
</tr>
<tr>
<td><img src="'. $site['setting']['base'] .'/img/num/09/11/5.jpg" width="300" height="181" alt="Реалистичные капли воды"></td>
<td><b>Шаг 5</b>: Нажмите CTRL и кликните на слое <i>droplet</i>, чтобы сформировать выделение вокруг капли. Создайте новый прозрачный слой поверх всех остальных, назовите его, например, <i>reflection (отражение)</i> и сделайте активным. Далее инструментом <b>Градиент</b>, установите линейный бело-прозрачный градиент и переместите курсор по диагонали внутри капли. Создастся градиентная заливка, как показано на рисунке слева.</td>
</tr>
<tr>
<td><img src="'. $site['setting']['base'] .'/img/num/09/11/6.jpg" width="300" height="182" alt="Реалистичные капли воды"></td>
<td><b>Шаг 6</b>: Выберите <b>Редактирование > Трансформация > Масштаб (Edit > Transform > Scale)</b>  из главного меню и уменьшите <i>высоту и ширину </i>до 80% от первоначального размера. Установите мутноватость слоя <i>reflection</i> в 80%. Потом переместите отражение света чуть вверх и влево. Реалистичная капля воды готова.
<br><br>
<b>ВНИМАНИЕ</b>: <i>После всего перечисленного используйте инструмент <b>Смазывание</b>, чтобы добавить капле немного оптического искажения. Можно также добавить слой, имитирующий внутреннее отражение</i>.</td>
</tr>
</table>';
	break;

//-------------------------------------------------------------------------------------------------------

case '1009/index.html':
	$site['page']['title'] .= ' - Октябрь 2009';
	$site['page']['description'] .= ' Октябрь 2009.';
	$site['page']['body'] = '<h1>Октябрь 2009</h1>
<div class="block_menu"><div class="text">
<b><u>Содержание</u></b><br><br>
<ol>
	<li><a href="'. $site['setting']['base'] .'/1009/irrlicht_engine.html">Использование Irrlicht Engine</a></li>
	<li><a href="'. $site['setting']['base'] .'/1009/visual_c_vb_lugin.html">Visual C++ 6/Visual Basic 6: Работа с плагинами</a></li>
	<li><a href="'. $site['setting']['base'] .'/1009/asing_programing.html">Асинхронное программирование</a></li>
	<li><a href="'. $site['setting']['base'] .'/1009/motchet.html">Менеджер отчётов</a></li>
	<li><a href="'. $site['setting']['base'] .'/1009/pascal_to_delphi.html">Секреты Delphi или переход с Pascal’я</a></li>
	<li><a href="'. $site['setting']['base'] .'/1009/linekorn.html">О феномене ложных корней систем линейных алгебраических уравнений</a></li>
	<li><a href="'. $site['setting']['base'] .'/1009/tech_lang.html">Научно-технический язык</a></li>
	<li><a href="'. $site['setting']['base'] .'/1009/Symfony.html">Введение в PHP фреймворки: Symfony</a></li>
	<li><a href="'. $site['setting']['base'] .'/1009/cms_drupal.html">CMS Drupal</a></li>
	<li><a href="'. $site['setting']['base'] .'/1009/open_source.html">Мир Open source</a></li>
	<li><a href="'. $site['setting']['base'] .'/1009/real_drop_water.html">Реалистичные капли воды</a></li>
</ol>
</div></div>
<br><br>
';
	break;
}
