#include<windows.h>
#include<d3d9.h>

#pragma comment(lib, "d3d9.lib")

HWND hWnd;
LPDIRECT3D9 pDirect3D=NULL;
LPDIRECT3DDEVICE9 pDirectDevice=NULL;

bool InitDirectX(void); //инициализация DirectX, если возвращено 0(false) - неудачная инициализация
void RenderScene(void); //рисование сцены
void Destroy3D(void);   //уничтожение выделеной памяти


LRESULT CALLBACK WindowProc(HWND hWnd, UINT message, WPARAM wParam, LPARAM iParam)
{
	switch(message)             //обработка сообщений окна
    {
    case WM_DESTROY:
		Destroy3D();    //освобождение созданых нами ресурсов
		PostQuitMessage(0);	
		break;
    case WM_CHAR:			//нажата любая клавиша, выход из приложения
		PostQuitMessage(0);
		break;
    case WM_SETCURSOR:		//если курсор захвачен то неотображать его
		SetCursor(NULL);
		break;
	}
	return(DefWindowProc(hWnd, message, wParam, iParam));
}//-----------------------------------------------------------------------------------
bool WindowInit(HINSTANCE hThisInst, int nCmdShow)
{
WNDCLASS wcl;				//класс окна
	wcl.hInstance=hThisInst;
	wcl.lpszClassName="DirectX 9";
	wcl.lpfnWndProc=WindowProc;
	wcl.style=0;
	wcl.hIcon=LoadIcon(hThisInst, IDC_ICON);
	wcl.hCursor=LoadCursor(hThisInst, IDC_ARROW);
	wcl.lpszMenuName=NULL;
	wcl.cbClsExtra=0;
	wcl.cbWndExtra=0;
	wcl.hbrBackground=(HBRUSH)GetStockObject(BLACK_BRUSH);
	RegisterClass(&wcl);
	hWnd=CreateWindowEx(WS_EX_TOPMOST, "DirectX 9", "DirectX 9", WS_POPUP, 0, 0, 1024, 768, NULL, NULL, hThisInst, NULL);
	if(!hWnd)
		return(false);	//ошибка, окно не создано
	return(true);		//окно создано
}//-----------------------------------------------------------------------------------
bool AppInit(HINSTANCE hThisInst, int nCmdShow)
{
    if(!WindowInit(hThisInst, nCmdShow))
        return(false);
    ShowWindow(hWnd, nCmdShow);
    UpdateWindow(hWnd);
    if(!InitDirectX())		//создание интерфейса DirectX
        return(false);		//интерфейс не создан, завершение приложения
    return(true);
}//-----------------------------------------------------------------------------------
int APIENTRY WinMain(HINSTANCE hThisInst, HINSTANCE hPrevInst, LPSTR lpCmdLine, int nCmdShow)
{
MSG msg;
	if(!AppInit(hThisInst, nCmdShow))
		return(false);
	ZeroMemory(&msg, sizeof(msg));
	while(msg.message!=WM_QUIT)
	{
		if(PeekMessage(&msg, NULL, 0, 0, PM_REMOVE))
		{
			TranslateMessage(&msg);
			DispatchMessage(&msg);
		}else
			RenderScene();
	}
	return(0);
}//-----------------------------------------------------------------------------------
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
	if(FAILED(pDirect3D->CreateDevice(D3DADAPTER_DEFAULT, D3DDEVTYPE_HAL, hWnd, D3DCREATE_HARDWARE_VERTEXPROCESSING, &Direct3DParametr, &pDirectDevice)))
		return(false);
	return(true);
}//-----------------------------------------------------------------------------------
void Destroy3D(void)
{
	if(pDirectDevice!=NULL)
		pDirectDevice->Release();
	if(pDirect3D!=NULL)
		pDirect3D->Release();
}//-----------------------------------------------------------------------------------
void RenderScene(void)
{
	if(pDirectDevice==NULL)
		return;
	pDirectDevice->Clear(0, NULL, D3DCLEAR_TARGET, D3DCOLOR_XRGB(0, 192, 0), 1.0f, 0);
	pDirectDevice->BeginScene();
	pDirectDevice->EndScene();
	pDirectDevice->Present(NULL, NULL, NULL, NULL);
}
