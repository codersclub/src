program max_lab6;
uses crt,graph,dos;
type OParent=object
xx,yy,dxx,dyy:word;
constructor Init(x1,y1,dx1,dy1:word);
procedure windows(x,y,dx,dy:word;color:byte); virtual;
procedure writetext;virtual;
end;
constructor OParent.init;
begin
xx:=x1;
yy:=y1;
dxx:=dx1;
dyy:=dy1;
end;
procedure OParent.windows;
begin
setfillstyle(1,color);
bar(x,y,dx,dy);
end;
procedure OParent.writetext;
begin

end;
type Window=object(OParent)
str1:string;
constructor init(x1,y1,dx1,dy1:word;str:string);
procedure writetext;virtual;
procedure showWindow;virtual;
end;


constructor Window.init;
begin
xx:=x1;yy:=y1;dxx:=dx1;dyy:=dy1;
str1:=str;
end;

procedure window.writeText;
begin
setcolor(10);
outtextxy(xx+10,yy+round(dyy/30),str1);
end;

procedure Window.showWindow;
begin
windows(xx,yy,dxx+xx,dyy+yy,7);
windows(xx+2,yy+2,dxx+xx-2,yy+23,blue);
writetext;
end;

type ExitButton=object(OParent)
str:string;
constructor init(x1,y1,dx1,dy1:word;str1:string);
procedure oButton(h:byte);  virtual;
procedure nButton(h:byte);  virtual;
procedure crest; virtual;
procedure writetext;virtual;
procedure showButton(var fl:byte;x2,y2:word;h:byte); virtual;
end;
constructor ExitButton.init;
begin
xx:=x1;yy:=y1;dxx:=dx1;dyy:=dy1;
end;
procedure ExitButton.crest;
begin
setcolor(0);
line(xx+2,yy+3,xx+dxx-3,yy+dyy-3);
line(xx+dxx-2,yy+2,xx+2,yy+dyy-2);
end;
procedure ExitButton.oButton;
begin
windows(xx,yy,dxx+xx,dyy+yy,7);
setlinestyle(3,5,10);
if h=1 then crest else if h=2 then writetext;
setcolor(white);
line(xx,yy,xx+dxx,yy);
line(xx,yy,xx,yy+dyy);
setcolor(0);
line(xx+1,yy+dyy,xx+dxx,yy+dyy);
line(xx+dxx,yy+dyy,xx+dxx,yy+1);
end;
procedure ExitButton.nButton(h:byte);
begin
windows(xx,yy,dxx+xx,dyy+yy,7);
setlinestyle(3,5,10);
if h=1 then crest else if h=2 then writetext;
setcolor(0);
line(xx,yy,xx+dxx,yy);
line(xx,yy,xx,yy+dyy);
setcolor(white);
line(xx+1,yy+dyy,xx+dxx,yy+dyy);
line(xx+dxx,yy+dyy,xx+dxx,yy+1);
end;
procedure exitButton.showButton;
begin
if (x2>=xx) and (x2<=xx+dxx) and (y2>=yy) and (y2<=yy+dyy) then
begin  nButton(h); delay(10000); obutton(h); fl:=1;end;
end;

procedure exitButton.writetext;
begin
setcolor(red);
outTextxy(xx+round(dxx/4),yy+round(dyy/4),str);
end;

type scrol=object(OParent)
xs,ys:word;
xw,yw,dxw,dyw:word;
constructor init(x1,y1,dx1,dy1:word);
procedure OutText(var f1:text);
procedure showForm(color:byte);
procedure start(var f:text; var f1:text);
procedure copy_file(var f:text; var f1:text);
end;
constructor scrol.init;
begin
xx:=x1;
yy:=y1;
dxx:=dx1;
dyy:=dy1;
end;

procedure scrol.showForm;
begin
windows(xx,yy,xx+dxx,yy+dyy,color);
 setcolor(0);
 line(xx,yy,xx+dxx,yy);
 line(xx,yy,xx,yy+dyy);
 setcolor(white);
 line(xx,yy+dyy,xx+dxx,yy+dyy);
 line(xx+dxx,yy+dyy,xx+dxx,yy);
end;

procedure scrol.outtext;
var
sr,sw:string;
dy,i,j:byte;
sch1,sc:word;
begin
showForm(7);
reset(f1);
dy:=2;
for i := 1 to ys-1 do
 begin
    readln(f1, sr);
{    if length(st) > maxlength then maxlength := length(st);}
      if eof(f1) then
      begin
         ys := i;
         break;
      end;
   end;
   for i := ys to ys + 20 do
   begin
      if eof(f1) then break;
      readln(f1, sr);
{      if length(st) > maxlength then maxlength := length(st);}
      sw := '';
      for j := xs to xs + 27 do
         if j > length(sr) then break else
         sw := sw + sr[j];
      inc(dy,10);
      OutTextXY(xx+2, yy+dy, sw);
   end;
   close(f1);
end;



type Button= object(exitButton)
constructor init(x1,y1,dx1,dy1:word;str1:string);
end;
constructor Button.init;
begin
xx:=x1;yy:=y1;dxx:=dx1;dyy:=dy1;
str:=str1;
end;




type OutputInput=object(OParent)
str:string;
constructor Init(x1,y1,dx1,dy1:word;str1:string);
procedure OutIn(var str1:string);virtual;
procedure openfile(var f:text;var name:string; fl:byte);
end;
constructor OutputInput.init;
begin
 xx:=x1;yy:=y1;dxx:=dx1;dyy:=dy1; str:=str1; end;
procedure  OutputInput.OutIn;
begin
 windows(xx,yy,xx+dxx,yy+dyy,blue);
 setcolor(white);
 line(xx,yy,xx+dxx,yy);
 line(xx,yy,xx,yy+dyy);
 setcolor(7);
 line(xx,yy+dyy,xx+dxx,yy+dyy);
 line(xx+dxx,yy+dyy,xx+dxx,yy);
 OutTextXY(xx+4, yy+5, str);
 textBackground(red);
 GoToXY(26, 24);
 readln(str1);
 windows(xx,yy,xx+dxx,yy+dyy,0);
 bar(xx,yy,xx+dxx+100,yy+dyy+100);
 end;

procedure OutputInput.OpenFile;
begin
OutIn(name);
{$I-}
repeat
if name=''then name:='c::';
assign(f,name);
reset(f);
if ioresult<>0 then
begin
OutIn(name);
end;
close(f);
until ioresult=0;
{$I+}
case fl of
1:reset(f);
2:rewrite(f);
end;
end;


procedure scrol.start;
var
s,s1:string;
i:byte;
begin
reset(f);
assign(f1,'c:\rename.txt');
rewrite(f1);
s1:='';
while not(eof(f)) do
begin
s1:='';
readln(f,s);
for i:=1 to length(s) do
if ((ord(s[i])>0)and (ord(s[i])<48)) or((ord(s[i])>57) and (ord(s[i])<256)) then
s1:=s1+s[i];
if not(s1='') then
writeln(f1,s1);
end;
xs:=1;
ys:=1;
outtext(f1);
close(f);
end;

procedure scrol.copy_file;
var
str:string;
begin
rewrite(f);
reset(f1);
while not(eof(f1)) do
begin
 readln(f1,str);
 writeln(f,str);
end;
close(f);
close(f1);
end;


var
f,f1:text;
mode,driver:integer;
win1,win2:window;
sc1,sc2,sc3,sc4,s1,s2,s3,s4:ExitButton;
txt,txt1:scrol;
ex1,ex2:ExitButton;
bl,bst,bsa:Button;
mes:OutputInput;
lb:boolean;
name_file:string;
xm,ym:word;
b:button;
flag,i:byte;
renameFile:string;
bum:array [1..5] of byte;
sc:array [1..8] of byte;

const
mesx=200;
mesy=325;
mesdx=250;
mesdy=40;
win1x=10;
winy=20;
win2x=300;
dwy=300;
dwx=270;



function resetMouse:boolean;
var
r:registers;
begin
 r.ax:=0;
 intr($33,r);
 resetmouse:=r.ax=$FFF;
end;

procedure showmousecursor;
var
r:registers;
begin
 r.ax:=1;
 intr($33,r);
end;
procedure readmous;
var
r:registers;
begin
r.ax:=3;
intr($33,r);
xm:=r.cx;
ym:=r.dx;
lb:=(r.bx and 1 )<>0;
end;

procedure hideMouseCursor;
var
r:registers;
begin
r.ax:=2;
intr($33,r);
end;

procedure readmouse;
begin
lb:=false;
 repeat

  readmous;
 until lb = true;
end;

procedure initilize;
begin
driver:=3;
mode:=2;
lb:=resetmouse;
initGraph(driver,mode,'c:\tp\bgi');
win1.init(win1x,winy,dwx,dwy,'Laboratories the max');
win2.init(win2x,winy,dwx,dwy,'Window number 2');
txt.init(win1x+5,winy+60,dwx-30,dwy-80);
txt1.init(win2x+5,winy+60,dwx-30,dwy-80);
win1.ShowWindow;
win2.showWindow;
ex1.init(win1x+dwx-22,winy+2,20,20,'');
ex2.init(win2x+dwx-22,winy+2,20,20,'');
sc1.init(win1x+dwx-20,winy+60,15,15,'');
sc2.init(win1x+dwx-20,winy+dwy-34,15,15,'');
sc3.init(win1x+dwx-40,winy+dwy-17,15,15,'');
sc4.init(win1x+5,winy+dwy-17,15,15,'');
s1.init(win2x+dwx-20,winy+60,15,15,'');
s2.init(win2x+dwx-20,winy+dwy-34,15,15,'');
s3.init(win2x+dwx-40,winy+dwy-17,15,15,'');
s4.init(win2x+5,winy+dwy-17,15,15,'');
sc1.oButton(3);
sc2.oButton(3);
sc3.oButton(3);
sc4.oButton(3);
s1.oButton(3);
s2.oButton(3);
s3.oButton(3);
s4.oButton(3);
txt.showForm(7);
txt1.showForm(7);
ex1.oButton(1);
ex2.oButton(1);
bl.init(win1x+10,winy+30,60,20,'LOAD');
bst.init(win1x+100,winy+30,60,20,'Start');
bsa.init(win2x+10,winy+30,60,20,'Save');
bl.oButton(2);
bst.oButton(2);
bsa.oButton(2);
mes.init(mesx,mesy,mesdx,mesdy,'Enter name file:');
showmousecursor;
end;

procedure nulmas;
var i:1..8;
begin
for i:=1 to 5 do
bum[i]:=0;
for i:=1 to 8 do
sc[i]:=0;
end;

begin
initilize;
repeat
showmousecursor;
readmouse;
nulmas;
hidemousecursor;
ex1.showButton(bum[1],xm,ym,1);
bl.showButton(bum[2],xm,ym,2);
bst.showButton(bum[3],xm,ym,2);
bsa.showButton(bum[4],xm,ym,2);
ex2.showButton(bum[5],xm,ym,1);
sc1.showButton(sc[1],xm,ym,3);
sc2.showButton(sc[2],xm,ym,3);
sc3.showButton(sc[3],xm,ym,3);
sc4.showButton(sc[4],xm,ym,3);
s1.showButton(sc[5],xm,ym,3);
s2.showButton(sc[6],xm,ym,3);
s3.showButton(sc[7],xm,ym,3);
s4.showButton(sc[8],xm,ym,3);

if sc[1]=1 then
begin
if txt.ys>1 then
txt.ys:=txt.ys-1
else txt.ys:=1;
txt.outtext(f);
end;
if sc[2]=1 then
begin
txt.ys:=txt.ys+1;
txt.outtext(f);
end;
if sc[3]=1 then
begin
txt.xs:=txt.xs+1;
txt.outtext(f);
end;
if sc[4]=1 then
begin
if txt.xs>1 then
txt.xs:=txt.xs-1
else
txt.xs:=1;
txt.outtext(f);
end;
if sc[5]=1 then
begin
if txt1.ys>1 then
txt1.ys:=txt1.ys-1
else txt1.ys:=1;
txt1.outtext(f1);
end;
if sc[6]=1 then
begin
txt1.ys:=txt1.ys+1;
txt1.outtext(f1);
end;
if sc[7]=1 then
begin
txt1.xs:=txt1.xs+1;
txt1.outtext(f1);
end;
if sc[8]=1 then
begin
if txt1.xs>1 then
txt1.xs:=txt1.xs-1
else
txt1.xs:=1;
txt1.outtext(f1);
end;
if bum[2]=1 then
begin
mes.openfile(f,name_file,1);
txt.xs:=1;
txt.ys:=1;
txt.outtext(f)
end;
if bum[3]=1 then
begin
txt1.start(f,f1);
end;
if bum[4]=1 then
begin
end;
showmousecursor;
until (bum[1]=1) or (bum[5]=1);
erase(f1);
end.
{magio_max@mail.ru пиши если хочешь кодить вместе}
