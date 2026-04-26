library Project2;
uses
  windows,
  messages;



function getmname:string;
var h: hwnd;
    buf: array[0..255] of char;
    l: integer;
begin
 h := findwindow(pchar('winamp v1.x'), nil);
 l := sendmessage(h, wm_gettextlength, 0, 0);
 sendmessage(h, wm_gettext, l+1, integer(@buf));
 result := copy(buf, pos('.', buf)+2, l-pos(' - winamp', buf)-length(' - winamp')-pos('.', buf));
end;

function procname(mWnd, aWnd: HWND; data, parms: PChar; show, nopause: boolean):integer;stdcall;
begin
 lstrcpy(data, PChar(getmname));
 result:=3;
end;

exports procname;

begin
end.
 