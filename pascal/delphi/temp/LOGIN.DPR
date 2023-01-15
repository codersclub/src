program login;

{$apptype console}

{
Sample password protected CGI program
(remember to rename login.exe to nph-login.exe, and login.ini to nph-login.ini)
(Delphi doesn't allow "nph-login" as program name)

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
  protect; // need a password

var
 i:integer;
 p:pchar;

begin
// because this cgi is nph-*, you can specify your own HTTP header

 if Authorized then begin

  WriteLn('HTTP/1.0 200 Welcome !');
  WriteLn('Content-type: text/html');
  Writeln;
  WriteLn('<html><head><title>Welcome</title></head><body>');
  WriteLn('Welcome ',UserName(User),' !');
  WriteLn('Last access ',Last);

 end else begin

  WriteLn('HTTP/1.0 401 Unauthorized');
  WriteLn('Content-type: text/html');
  WriteLn('WWW-Authenticate: Basic realm="/MyRealm"');
  WriteLn;
  Writeln('<html><head><title>401 Unauthorized</title></head><body>');
  WriteLn('<h1>You need a password to access this page !</h1>');
  WriteLn('<a href="/">Home</a>');

 end;

 WriteLn('</body></html>');
end.
