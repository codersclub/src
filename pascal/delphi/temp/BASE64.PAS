Unit Base64;

{ Base64 Unit
   - StrToBase64
   - Base64ToStr

Copyright (C) 1997-98 TothPaul@Mygale.org
 http://www.Mygale.org\~tothpaul

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.

}

{ From : UNBASE64.PAS - SWAG
{ Decode base-64 files, Arne de Bruijn, 1996, Released to the Public Domain }


Interface

Function StrToBase64(Const s:string):string;
Function Base64ToStr(Const s:string):string;

Implementation

Const
 B64:array[0..63] of char=
     'ABCDEFGHIJKLMNOPQRSTUVWXYZ'+ { 26 }
     'abcdefghijklmnopqrstuvwxyz'+ { 52 }
     '0123456789'+                 { 62 }
     '+/';                         { 64 }

{

 BIN to B64 :

BIN: [76543210]
C1 : [--765432]  (shr 2)           ; 1
C2 : [--10....] ((shl 4) and 127)  ; 2 , 4 = 6-2

     [76543210]
     [--..7654]  (shr 4)           ; 2
     [--3210..] ((shl 2) and 127)  ; 3 , 2 = 6-4

     [76543210]
     [--....76]  (shr 6)           ; 3
     [--543210] ((shl 0) and 127)  ; 4 , 0 = 6-0

 B64 to BIN :

B64: [--DCBA98][--543210]
C1 : [DCBA98..] (shl 2)
C2 : [....--54] (shr 4)

     [--DCBA98][--543210]
     [BA98....] (shl 4)
     [..--5432] (shr 2)

     [--DCBA98][--543210]
     [98......] (shl 6)
     [--543210] (shr 0)
}

Var
 c1,c2:byte;
 Shift:byte;
 i:byte;

Function StrToBase64(Const s:string):string;
 begin
  Result:='';
  c2:=0;
  Shift:=2;
  for i:=1 to length(s) do begin
   c1:=ord(s[i]);
   Result:=Result+B64[c2 or c1 shr Shift];
   c2:=(c1 shl (6-Shift)) and 63;
   Shift:=(Shift+2) and 7;
   if Shift=0 then begin
    Shift:=2;
    Result:=Result+B64[c2];
    c2:=0;
   end;
  end;
  if (Shift>2) then Result:=Result+B64[c2];
  StrToBase64:=Result;
 end;

Function Base64ToStr(Const s:string):string;
 begin
  Result:='';
  Shift:=0;
  For i:=1 to length(s) do begin
   if s[i]='=' then break;
   c2:=pos(s[i],B64)-1;
   if Shift>0 then Result:=Result+chr((c1 shl shift) or (c2 shr (6-shift)));
   shift:=(shift+2)and 7;
   c1:=c2;
  end;
  Base64ToStr:=Result;
 end;


end.