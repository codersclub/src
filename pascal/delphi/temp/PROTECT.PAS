unit protect;

interface
{
Copyright (C) 1998 TothPaul@Mygale.org
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

uses
 classes;

Function Authorized:boolean;
Function UserName(User:string):string;

Var
 User:string; // username
 date:string; // current date
 Last:string; // Last access

implementation

Uses
 Base64,inifiles,windows,sysutils;

Var
 Auth:string; // HTTP_AUTHORIZATION
 pwd :string; // password
 Ini :TIniFile;

Function Authorized:boolean;
 var
  buff:Array[0..50] of char;
 begin
 // default reply
  Result:=false;
 // "HTTP_AUTORIZATION=Basic <user:password>=="
  if GetEnvironmentVariable('HTTP_AUTHORIZATION',Buff,SizeOf(Buff))=0 then exit;
  Auth:=buff;
  Auth:=copy(auth,pos(' ',auth)+1,length(auth));
 // Decode
  Auth:=Base64toStr(auth);
  user:=copy(auth,1,pos(':',auth)-1); if user='' then exit;
  pwd :=copy(auth,length(user)+2,length(auth));
 // Log
  ShortDateFormat:='mm/dd/yy - hh:mm';
  date:=DateToStr(now);
 // IniFile
  With ini do begin
  // unauthorized
   If Not ReadBool('Users',user,false) then exit;
  // invalid password
   If ReadString(User,'Password','')<>pwd then exit;
  // Okay !
   Result:=true;
   Last:=ReadString(User,'LastDate','(never)');
   WriteString(user,'LastDate',date);
  end;
 end;

Function UserName(User:string):string;
 begin
  Result:=Ini.ReadString(User,'FullName','(unknow)');
 end;

begin
 Ini:=TIniFile.Create(ChangeFileExt(paramstr(0),'.ini'));
end.
