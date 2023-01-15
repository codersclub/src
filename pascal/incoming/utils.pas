
{-------------------------------}unit  Utils{---------------------------};
{--------------------------------}interface{----------------------------}
uses crt;
const
	StdPal:array [0..15] of byte=
		($00,$01,$02,$03,$04,$05,$14,$07,$38,$39,$3A,$3B,$3C,$3D,$3E,$3F);

	{Foreground &Background}
	Black     =0       ;
	Blue      =1       ;
	Green     =2       ;
	Cyan      =3       ;
	Red       =4       ;
	Magenta   =5       ;
	Brown     =6       ;
	LightGray =7       ;

	{Light Colors:
	(Foreground}
	DarkGray     = 8   ;
	LightBlue    = 9   ;
	LightGreen   =10   ;
	LightCyan    =11   ;
	LightRed     =12   ;
	LightMagenta =13   ;
	Yellow       =14   ;
	White        =15   ;

	Up___Key     =#72  ;
	Down_Key     =#80  ;
	Left_Key     =#75  ;
	RightKey     =#77  ;
	End__Key     =#79  ;
	Home_Key     =#71  ;
	Esc__Key     =#27  ;
	EnterKey     =#13  ;
	Tab__Key     =#09  ;
	F1___Key     =#59  ;
	F2___Key     =#60  ;
	F3___Key     =#61  ;
	F4___Key     =#62  ;
	F5___Key     =#63  ;
	F6___Key     =#64  ;
	F7___Key     =#65  ;
	F8___Key     =#66  ;
	F9___Key     =#67  ;
	F10__Key     =#68  ;
{	F11__Key     =#69  ;
	F12__Key     =#70  ;}

Const
	ShadowOn  =True ;
	ShadowOff =False;
	CondensOn =true ;
	CondensOff=false;
	BlinkOn   =True ;
	BlinkOff  =False;
	On        =True ;
	Off       =False;

var
		 FirstPage:pointer absolute $B800:$0000;
		SecondPage:pointer absolute $B800:$0FA0;

function AreYouSure:boolean;


function ByteToHex(W:Word    ):String;
function WordToHex(W:Word    ):String;
function IntToStr (I:LongInt ):String;
function StrToInt (Str:String):Integer;
function Bin(b:string):byte;
function BinW(b:string):word;
function Dec2Bin(b:byte):string;
function Dec2BinW(b:word):string;

procedure CurEmulOn;
procedure CurEmulOff;

procedure NumLockOn;
procedure NumLockOff;
procedure CapsLockOn;
procedure CapsLockOff;
procedure ScrollLockOn;
procedure ScrollLockOff;

procedure ShowCursor;
procedure SetCursor(Top,Bottom:byte);
procedure HideCursor;

function ShiftPressed:Boolean;
function RShiftPressed:Boolean;
function LShiftPressed:Boolean;
function AltPressed  :Boolean;
function CtrlPressed :Boolean;

procedure ClearTextBuf;
procedure KeyAutoRepeat(a:boolean);
procedure Beep;
procedure Pause(ms:word);
var UtilsCh:char;
procedure WaitKeyPress;

procedure WriteTo(x,y:Integer;ch:char);
function  ReadFrom(x,y:byte):char;
procedure WriteStrTo(x,y:Integer;Str:String);
procedure SetColorTo(x,y:Integer;Back,Sumb:integer;Blink:boolean);
procedure WriteColorStrTo(x,y:Integer;Str:String;Back,Sumb:integer;Blink:boolean);
procedure SetBlinkTo(x,y:Integer;Blink:boolean);
procedure TextColors(Back,Ink:word);

procedure ShadowWindow(x1,y1,x2,y2,Back,Sumb:Integer;Blink:boolean;FrameLine :byte);
procedure       Window(x1,y1,x2,y2,Back,Sumb:Integer;Blink:boolean;FrameLine :byte);
procedure ShadowFrame (x1,y1,x2,y2,Back,Sumb:Integer;Blink:boolean;FrameLine :byte);
procedure       Frame (x1,y1,x2,y2,Back,Sumb:Integer;Blink:boolean;FrameLine :byte);
procedure FullScreenWnd;
procedure SetColorRect(x1,y1,x2,y2,Back,Sumb:Integer;Blink:boolean);
procedure FillRect(x1,y1,x2,y2,Back,Sumb:Integer;Blink:boolean;ch:char);
procedure FillScreen(Back,Ink:byte;ch:char);
procedure ClearScreen;

type
	TCharView=array [1..16] of byte;
procedure GetSymbol(var c:TCharView;Tab,ch:byte);
procedure SetSymbol(c:TCharView;Tab,ch:byte);

procedure PlotToSprite(Tab,ch,x,y,sx,sy,col:byte);
procedure ShowSpriteTo(x,y,sx,sy,Symbol:byte);

procedure GetSymbolTables(var t1,t2:byte);
procedure SetSymbolTables(t1,t2:byte);
procedure LoadDefaultSymbols(Tab:byte);

procedure SetStandartPalette;
procedure GetPaletteColor(n:byte;var val:Byte);
procedure SetPaletteColor(n,val:Byte);

procedure ModeCO80;

{-----------------------------}implementation{---------------------------}

uses dos;

{***************************************************************************}

PROCEDURE PutToKeybordBuffer( key:word );
begin
  if MemW[$40:$1C] = $3C
    then
      begin
        if MemW[$40:$1A] = $1C then begin write(#7);exit end;
	MemW[$40:$3C]:=key;
	MemW[$40:$1C]:= $1E;
      end
    else
      begin
        if MemW[$40:$1A] = (MemW[$40:$1C]+2) then begin write(#7);exit end;
	MemW[$40:MemW[$40:$1C]]:=key;
	inc(MemW[$40:$1C],2) ;
      end
end;

{***************************************************************************}

function AreYouSure:boolean;
var
	State:(Yes,No);

	procedure Show;
	var BackYes,BackNo:byte;
	begin
		case State of
			Yes:begin BackYes:=LightGray; BackNo :=Red end;
			No :begin BackNo :=LightGray; BackYes:=Red end;
			end;{case}
		SetColorTo(37,14,BackYes,yellow,BlinkOff);
		SetColorTo(38,14,BackYes,white ,BlinkOff);
		SetColorTo(42,14,BackNo,yellow,BlinkOff);
		SetColorTo(43,14,BackNo,white ,BlinkOff);
		SetColorTo(44,14,BackNo,white ,BlinkOff);
		WriteStrTo(37,14,'Да   Нет');
	end;

begin
	State:=Yes;
	window(    31,10,49,16,Brown,White,BlinkOff,2);
	Writestrto(35,12,'Вы уверенны?');
	Show;
	repeat
	 case ReadKey of
		 #13:case State of
			 Yes:begin AreYouSure:=True ;exit end;
			 No :begin AreYouSure:=False;exit end;
			 end;{case}
		 'н','Н','y','Y',#27:begin AreYouSure:=False;exit end;
		 'д','Д','l','L'    :begin AreYouSure:=True ;exit end;
		 '6','4',#9:begin
			 if State=No  then State:=Yes else State:=No ;
			 Show;
			 end;
		 #0:case ReadKey of
			 #75,#77:begin
				 if State=No  then State:=Yes else State:=No ;
				 Show;
				 end;
			 end{case ReadKey}
	 end;{case}
	until false;
end;

{***************************************************************************}

procedure beep;
begin
	 Sound(220);        { Beep }
	 Delay(200);        { For 200 ms }
	 NoSound;           { Relief! }
end;

{***************************************************************************}

procedure Pause(ms:word);
begin
	delay(ms);
end;

{***************************************************************************}

procedure KeyAutoRepeat(a:boolean);
var
	regs: Registers;
begin
{	with regs do
	begin
		ah:=3;
		al:=5;
		if a then bh:=0 else bh:=3;
		bl:=1;
		intr($16,regs);
	end;}
end;

{***************************************************************************}
{***************************************************************************}

procedure NumLockOn;
begin
	 mem[$40:$17]:=mem [$40:$17] or $20;
	 asm
		 mov ah,$01
		 int $16
	 end;
end;

{***************************************************************************}

procedure NumLockOff;
begin
	 mem[$40:$17]:=mem[$40:$17] and not $20;
	 asm
		 mov ah,$01
		 int $16
	 end;
end;

{***************************************************************************}

procedure CapsLockOn;
begin
	 mem[$40:$17]:=mem [$40:$17] or $40;
	 asm
		 mov ah,$01
		 int $16
	 end;
end;

{***************************************************************************}

procedure CapsLockOff;
begin
	 mem[$40:$17]:=mem[$40:$17] and not $40;
	 asm
		 mov ah,$01
		 int $16
	 end;
end;

{***************************************************************************}

procedure ScrollLockOn;
begin
	 mem[$40:$17]:=mem [$40:$17] or $10;
	 asm
		 mov ah,$01
		 int $16
	 end;
end;

{***************************************************************************}

procedure ScrollLockOff;
begin
	 mem[$40:$17]:=mem[$40:$17] and not $10;
	 asm
		 mov ah,$01
		 int $16
	 end;
end;

{***************************************************************************}

function LShiftPressed:Boolean;
begin
	LShiftPressed:=(mem[$40:$17] and $02)<>0;
end;

{***************************************************************************}

function RShiftPressed:Boolean;
begin
	RShiftPressed:=(mem[$40:$17] and $01)<>0;
end;

{***************************************************************************}

function ShiftPressed:Boolean;
begin
	ShiftPressed:=LShiftPressed or RShiftPressed;
end;

{***************************************************************************}

function AltPressed  :Boolean;
begin
	AltPressed:=(mem[$40:$17] and $08)<>0;
end;

{***************************************************************************}

function CtrlPressed :Boolean;
begin
	CtrlPressed:=(mem[$40:$17] and $04)<>0;
end;

{***************************************************************************}

procedure ClearTextBuf;
begin
	mem[$40:$1A]:=mem[$40:$1C];
end;

{***************************************************************************}
{***************************************************************************}

procedure WriteTo(x,y:Integer;ch:char);
begin
	Dec(x);
	Dec(y);
	mem [$b800:(y*80+x)*2]:=ord(ch);
end;

{***************************************************************************}

function  ReadFrom(x,y:byte):char;
begin
	Dec(x);
	Dec(y);
	ReadFrom:=chr(mem [$b800:(y*80+x)*2]);
end;

{***************************************************************************}

procedure WriteStrTo(x,y:Integer;Str:String);
var n:byte;
begin
	for n:=1 to length(str) do
		WriteTo((x+n-1)mod 80,y+(x+n-1)div 80,Str[n]);
end;

{***************************************************************************}

procedure SetColorTo(x,y:Integer;Back,Sumb:integer;Blink:boolean);
var ch:byte;
begin
	Dec(x);
	Dec(y);
	if not (Sumb in [0..15] ) or not (Back in [0..07])then exit;
	ch:=sumb+back shl 4;
	if Blink then ch:=ch or 128;
	mem [$b800:(y*80+x)*2+1]:=ch;
end;

{***************************************************************************}

procedure WriteColorStrTo(x,y:Integer;Str:String;Back,Sumb:integer;Blink:boolean);
var n:byte;
begin
	for n:=1 to length(str) do begin
		WriteTo   ((x+n-1)mod 80,y+(x+n-1)div 80, Str[n]);
		SetColorTo((x+n-1)mod 80,y+(x+n-1)div 80, Back,Sumb,Blink);
		end;
end;

{***************************************************************************}

procedure SetBlinkTo(x,y:Integer;Blink:boolean);
var ch:byte;
begin
	Dec(x);
	Dec(y);
	ch:=mem [$b800:(y*80+x)*2+1];
	if Blink then ch := ch or 128 else ch := ch and not 128;
	mem [$b800:(y*80+x)*2+1]:=ch;
end;

{***************************************************************************}
{***************************************************************************}

procedure Frame (x1,y1,x2,y2,Back,Sumb:Integer;Blink:boolean;FrameLine :byte);
var x,y:byte;
begin
	for y:=y1 to y2 do
		for x:=x1 to x2 do
			SetColorTo(x,y,Back,Sumb,Blink);

	for y:=y1+1 to y2-1 do
		begin
			for x:=x1+1 to x2-1 do
				{writeTo(x,y,' ')};
			if (y>y1) and (y<y2) then begin
				case FrameLine  of
					1:WriteTo(x1,y,'│');
					2:writeTo(x1,y,'║');
					else writeTo(x1,y,' ');
				end;
				case FrameLine  of
					1:WriteTo(x2,y,'│');
					2:writeTo(x2,y,'║');
					else writeTo(x2,y,' ');
				end;
			end;{if}
		end;
	for x:=x1 to x2 do
		begin
			case FrameLine  of
				1:WriteTo(x,y1,'─');
				2:writeTo(x,y1,'═');
				else writeTo(x,y1,' ');
			end;
			case FrameLine  of
				1:WriteTo(x,y2,'─');
				2:writeTo(x,y2,'═');
				else writeTo(x,y2,' ');
			end;
		end;
	case FrameLine  of
		1:begin
			WriteTo(x1,y1,'┌');
			WriteTo(x1,y2,'└');
			WriteTo(x2,y1,'┐');
			WriteTo(x2,y2,'┘');
			end;
		2:begin
			WriteTo(x1,y1,'╔');
			WriteTo(x1,y2,'╚');
			WriteTo(x2,y1,'╗');
			WriteTo(x2,y2,'╝');
			end;

	end;{case}
end;

{***************************************************************************}

procedure ShadowFrame (x1,y1,x2,y2,Back,Sumb:Integer;Blink:boolean;FrameLine :byte);
var x,y:byte;
begin

	Frame(x1,y1,x2,y2,Back,Sumb,Blink,FrameLine );
	for y:=y1 to y2 do
		begin
			SetColorTo(x2+1,y+1,Black,DarkGray,false);
			SetColorTo(x2+2,y+1,Black,DarkGray,false);
		end;
	for x:=x1+1 to x2 do SetColorTo(x+1,y2+1,Black,DarkGray,false);
end;

{***************************************************************************}

procedure Window(x1,y1,x2,y2,Back,Sumb:Integer;Blink:boolean;FrameLine :byte);
begin
	Frame(x1,y1,x2,y2,Back,Sumb,Blink,FrameLine );
	crt.window(x1+1,y1+1,x2-1,y2-1);
	TextColors(Back,Sumb);ClrScr;
end;

{***************************************************************************}

procedure ShadowWindow(x1,y1,x2,y2,Back,Sumb:Integer;Blink:boolean;FrameLine :byte);
var x,y:byte;
begin

	Window(x1,y1,x2,y2,Back,Sumb,Blink,FrameLine );
	for y:=y1 to y2 do
		begin
			SetColorTo(x2+1,y+1,Black,DarkGray,false);
			SetColorTo(x2+2,y+1,Black,DarkGray,false);
		end;
	for x:=x1+1 to x2 do SetColorTo(x+1,y2+1,Black,DarkGray,false);
end;

{***************************************************************************}

procedure FullScreenWnd;
begin
	crt.Window(1,1,80,25)
end;

{***************************************************************************}

procedure FillScreen(Back,Ink:byte;ch:char);
var
	i,tmp:word;
	attrib:byte;
begin
{	if not (Ink in [0..15] ) or not (Back in [0..7])then exit;}
	attrib:=Ink+Back shl 4;

	tmp:=(attrib shl 8) + ord(ch);

	for i:=0 to 80*25 do memW[$b800:i*2]:=tmp;

end;

{***************************************************************************}

procedure FillRect(x1,y1,x2,y2,Back,Sumb:Integer;Blink:boolean;ch:char);
var x,y:byte;
begin
	for y:=y1 to y2 do
		for x:=x1 to x2 do
		begin
			SetColorTo(x,y,Back,Sumb,Blink);
			WriteTo(x,y,ch);
		end;
end;

{***************************************************************************}

procedure SetColorRect(x1,y1,x2,y2,Back,Sumb:Integer;Blink:boolean);
var x,y:byte;
begin
	for y:=y1 to y2 do
		for x:=x1 to x2 do
			SetColorTo(x,y,Back,Sumb,Blink);
end;

{***************************************************************************}
{***************************************************************************}

procedure ClearScreen;
begin
	FullScreenWnd;
	TextColors(Black,White);
	ClrScr;
end;

{***************************************************************************}
{***************************************************************************}

procedure CurEmulOn;
begin
	asm
		{Разрешение эмуляции      }
		mov ah,$12
		mov al,$00  {!!!}
		mov bl,$34
		int $10
	end;
end;


{***************************************************************************}

procedure CurEmulOff;
begin
	asm
			{Запрет эмуляции      }
		mov ah,$12
		mov al,$01      {!!!}
		mov bl,$34
		int $10
	end;
end;

{***************************************************************************}

procedure ShowCursor;
begin
	CurEmulOn;
	asm     { chcl }
		{Ставим размер}
		mov cx,$0607
		mov ah,1
		int $10
	end;
end;

{***************************************************************************}

procedure SetCursor(Top,Bottom:byte);
begin
	asm
		{Ставим размер}
		mov ch,Top
		mov cl,Bottom
		mov ah,1
		int $10
	end;
end;

{***************************************************************************}

procedure HideCursor;
begin
	asm
		mov cx,$2000
		mov ah,1
		int $10
	end;
end;

{***************************************************************************}
{***************************************************************************}

procedure genModeSet;
begin

	asm
		cli {Запрет прерываний}
			mov dx,$03C4   { адрес порта секвенсора $03С4 }
				mov ax,$0100   {Загружаем al и ah }
				out dx,ax      {Програмируем регистр секвенсора al=номер,ah=значение }

				mov ax,$0402   {Загружаем al и ah }
				out dx,ax      {Програмируем регистр секвенсора al=номер,ah=значение }

				mov ax,$0604  { $0704}{Загружаем al и ah }
				out dx,ax      {Програмируем регистр секвенсора al=номер,ah=значение }

				mov ax,$0300   {Загружаем al и ah }
				out dx,ax      {Програмируем регистр секвенсора al=номер,ah=значение }
		sti            {Разрешение прерываний}

		mov dl,$CE     {Ставим адрес порта графического контролера $03СЕ }
			mov ax,$0204   {Загружаем al и ah }
			out dx,ax      {Програмируем регистр секвенсора al=номер,ah=значение }

			mov ax,$0005   {Загружаем al и ah }
			out dx,ax      {Програмируем регистр секвенсора al=номер,ah=значение }

			mov ax,$0006   {Загружаем al и ah }
			out dx,ax      {Програмируем регистр секвенсора al=номер,ah=значение }

	end;{Asm}
end; {Procedure genModeSet}

{***************************************************************************}

procedure genModeClear;
begin
	asm
		cli {Запрет прерываний}
			mov dx,$03C4   { адрес порта секвенсора $03С4 }
				mov ax,$0100   {Загружаем al и ah }
				out dx,ax      {Програмируем регистр секвенсора al=номер,ah=значение }

				mov ax,$0302   {Загружаем al и ah }
				out dx,ax      {Програмируем регистр секвенсора al=номер,ah=значение }

				mov ax,$0204  { $0404} {Загружаем al и ah }
				out dx,ax      {Програмируем регистр секвенсора al=номер,ah=значение }

				mov ax,$0300   {Загружаем al и ah }
				out dx,ax      {Програмируем регистр секвенсора al=номер,ah=значение }
		sti            {Разрешение прерываний}

		mov dl,$CE     {Ставим адрес порта графического контролера $03СЕ }
			mov ax,$0004   {Загружаем al и ah }
			out dx,ax      {Програмируем регистр секвенсора al=номер,ah=значение }

			mov ax,$1005   {Загружаем al и ah }
			out dx,ax      {Програмируем регистр секвенсора al=номер,ah=значение }

			mov ax,$0E06   {Загружаем al и ah }
			out dx,ax      {Програмируем регистр секвенсора al=номер,ah=значение }

	end;{Asm}
end; {procedure genModeClear}

{***************************************************************************}

procedure GetSymbol(var c:TCharView;Tab,ch:byte);
var
	i:word;
begin
	genModeSet;

	if Tab<4
		then tab:=(tab)*2
		else Tab:=(Tab-4)*2+1;

	for i:=1 to 16 do
		c[i]:=mem[($a000+Tab*$0200):Ch*32+i-1];

	genModeClear;

end;

{***************************************************************************}

procedure SetSymbol(c:TCharView;Tab,ch:byte);
var
	i:word;
begin
	genModeSet;

	if Tab<4
		then tab:=(tab)*2
		else Tab:=(Tab-4)*2+1;

	for i:=1 to 16 do
		mem[($a000+Tab*$0200):Ch*32+i-1]:= c[i];

	genModeClear;

end;

{***************************************************************************}

procedure PlotToSprite(Tab,ch,x,y,sx,sy,col:byte);
var
	ChCode:byte;
	Line,Mask,Offs:word;
begin
	genModeSet;

	ChCode:=ch+(x div 8 )+sx*(y div 16);
	Line:=y mod 16;
	Mask:=$80 shr (x mod 8);

	offs:=ChCode*32+Line;

	if Tab<4
		then tab:=(tab)*2
		else Tab:=(Tab-4)*2+1;

	if col=1
		then mem[$a000+Tab*$0200:Offs]:= mem[$a000+Tab*$0200:Offs] or       Mask
		else mem[$a000+Tab*$0200:Offs]:= mem[$a000+Tab*$0200:Offs] and (not Mask);

	genModeClear;

end;

{***************************************************************************}

procedure ShowSpriteTo(x,y,sx,sy,Symbol:byte);
var x1,y1:byte;
begin
	for y1:=0 to sy-1 do
		for x1:=0 to sx-1 do
			writeTo(x+x1,y+y1,chr(Symbol+x1+sx*y1));
end;

{***************************************************************************}

procedure GetSymbolTables(var t1,t2:byte);
var
	tmp:byte;
begin
	Port[$03c4]:=$03;
	tmp:=Port[$03c5];

	writeln('get tmp=',Dec2Bin(tmp),'. ');

	t1:= tmp and Bin('00010011');
	t2:=(tmp and Bin('00101100'))shr 2;

	writeln('get1 t1=',Dec2Bin(t1),',t2=',Dec2Bin(t2),'.');
	if t1 and Bin('00010000')<>0 then t1:=(t1 and Bin('00000011'))+4;
	if t2 and Bin('00001000')<>0 then t2:=(t2 and Bin('00000011'))+4;
	writeln('get2 t1=',Dec2Bin(t1),',t2=',Dec2Bin(t2),'.');
end;

{***************************************************************************}

procedure SetSymbolTables(t1,t2:byte);
var tmp:byte;
begin
	if (t1>7) or (t2>7)then exit;
	if t1>=4
		then tmp:=(t1 and Bin('00000011'))+$10
		else tmp:=(t1 and Bin('00000011'));

	write('1 tmp=',Dec2Bin(tmp),'. ');

	tmp:=tmp+((t2 and Bin('00000011'))shl 2);

	write('2 tmp=',Dec2Bin(tmp),'. ');

	if t2>=4 then tmp:=tmp+$20;

	write('3 tmp=',Dec2Bin(tmp),'. ');

	Port[$03c4]:=$03;
	Port[$03c5]:=tmp;

end;

{***************************************************************************}

procedure LoadDefaultSymbols(Tab:byte);assembler;
asm
	mov ax,$1114
	mov bl,Tab
	int $10
end;

{***************************************************************************}
{***************************************************************************}

procedure TextColors(Back,Ink:word);
begin
	TextColor(Ink);
	TextBackground(Back);
end;

{***************************************************************************}

procedure WaitKeyPress;
begin
	UtilsCh:=ReadKey;
end;

{***************************************************************************}
{***************************************************************************}

function IntToStr(I: Longint): String;
var
	S: string[11];
begin
	Str(I, S);
	IntToStr := S;
end;

{***************************************************************************}

function  StrToInt(Str:String):Integer;
var
	Value,Code:Integer;
begin
	repeat

		Val(Str,Value,Code);

		if code<>0 then Str[0]:=chr(code-1);

		if length(Str)=0 then code:=0;

	until code=0;
	StrToInt:=Value;
end;

{***************************************************************************}

function WordToHex(W:Word):String;
var
	tmp:string[5];
	b,b1:byte;
begin
	tmp[0]:=#5;
	tmp[5]:='h';

	b1:=Lo(w) and $0F;
	case b1 of
		0..9  :tmp[4]:=chr(ord('0')+b1);
		10..15:tmp[4]:=chr(ord('A')+b1-10);
	end;

	b1:=(Lo(w) shr 4)and $0F;
	case b1 of
		0..9  :tmp[3]:=chr(ord('0')+b1);
		10..15:tmp[3]:=chr(ord('A')+b1-10);
	end;

	b1:=Hi(w) and $0F;
	case b1 of
		0..9  :tmp[2]:=chr(ord('0')+b1);
		10..15:tmp[2]:=chr(ord('A')+b1-10);
	end;

	b1:=(Hi(w) shr 4)and $0F;
	case b1 of
		0..9  :tmp[1]:=chr(ord('0')+b1);
		10..15:tmp[1]:=chr(ord('A')+b1-10);
	end;
	WordToHex:=tmp;

end;

{***************************************************************************}

function ByteToHex(W:Word):String;
var
	tmp:string[3];
	b,b1:byte;
begin
	tmp[0]:=#3;
	tmp[3]:='h';

	b1:=w and $0F;
	case b1 of
		0..9  :tmp[2]:=chr(ord('0')+b1);
		10..15:tmp[2]:=chr(ord('A')+b1-10);
	end;

	b1:=(w shr 4)and $0F;
	case b1 of
		0..9  :tmp[1]:=chr(ord('0')+b1);
		10..15:tmp[1]:=chr(ord('A')+b1-10);
	end;

	ByteToHex:=tmp;

end;

{***************************************************************************}

function Dec2Bin(b:byte):string;
var
	i:byte;
	res:string[8];
begin
	for i:=1 to 8 do
		if (b and ($80 shr(i-1)))=0
			then Res[i]:='0'
			else Res[i]:='1';
	Res[0]:=#8;
	Dec2Bin:=Res;
end;

{***************************************************************************}

function Dec2BinW(b:Word):string;
var
	i:byte;
	res:string[16];
begin
	for i:=1 to 16 do
		if (b and ($8000 shr(i-1)))=0
			then Res[i]:='0'
			else Res[i]:='1';
	Res[0]:=#16;
	Dec2BinW:=Res;
end;

{***************************************************************************}

function Bin(b:string):byte;
var i,Res:byte;
begin
	if Length(b)<8 then exit;
	for i:=1 to 8 do
		case b[i] of
			'1':Res:=Res or ($80 shr (i-1));
			'0':Res:=Res and not  ($80 shr (i-1));
			else begin Bin:=0;exit end;
		end;{case}
	Bin:=Res;
end;

{***************************************************************************}

function BinW(b:string):word;
var i,Res:word;
begin
	if Length(b)<16 then exit;
	for i:=1 to 16 do
		case b[i] of
			'1':Res:=Res or ($8000 shr (i-1));
			'0':Res:=Res and not  ($8000 shr (i-1));
			else begin BinW:=0;exit end;
		end;{case}
	BinW:=Res;
end;

{***************************************************************************}
{***************************************************************************}

procedure SetPaletteColor(n,val:Byte);assembler;
asm
	mov ax,$1000
	mov bl,n
	mov bh,val
	int $10
end;

{***************************************************************************}

procedure GetPaletteColor(n:byte;var val:Byte);
var tmp:byte;
begin
	asm
		mov ah,$10
		mov al,$07
		mov bl,n
		int $10
		mov tmp,bh
	end;
 val:=tmp;
end;

{***************************************************************************}

procedure SetStandartPalette;
var
	i:Byte;
begin
	for i:=0 to 15 do SetPaletteColor(i,StdPal[i]);
end;

{***************************************************************************}
{***************************************************************************}

procedure ModeCO80;
begin
	SetSymbolTables(0,0);
	SetStandartPalette;
	LoadDefaultSymbols(0);
end;

end.