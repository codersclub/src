unit cgi;

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

interface

uses
 windows,classes,gif,sysutils,graphics;

var
 parmstring:string;
 parms:TStringList;

function getvar(varname:string):string;

procedure WriteStream(stream:TMemoryStream);
procedure WriteBitmap(Bitmap:TBitmap);
procedure WriteBitmapAsGIF(Bitmap:TBitmap);
procedure WriteFile(Filename:string);

implementation

function getvar(varname:string):string;
 var
  buffer:array[0..1024] of char;
  size:integer;
 begin
  size:=GetEnvironmentVariable(PChar(varname),buffer,sizeof(buffer));
  if size=0 then getvar:='' else getvar:=String(buffer);
 end;

procedure initcgi;
 const
  hexa:array[0..$F] of char='0123456789ABCDEF';
 var
  x:integer;
  n,v:string;
  procedure addchar(var s:string);
   begin
    if parmstring[x]='%' then begin
     inc(x);
     s:=s+chr(16*(pos(parmstring[x],hexa)-1)+pos(parmstring[x+1],hexa)-1);
     inc(x);
    end else begin
     s:=s+parmstring[x];
    end;
    inc(x);
   end;
 begin
 // get parm string
  if getvar('REQUEST_METHOD')='POST' then read(Parmstring) else parmstring:=getvar('QUERY_STRING');
 // create parms
  parms:=TStringList.create;
  x:=1;
  while x<=length(parmstring) do begin
   // get name
   n:=''; while (x<=length(parmstring))and(parmstring[x]<>'=') do addchar(n); inc(x);
   // get value
   v:=''; while (x<=length(parmstring))and(parmstring[x]<>'&') do addchar(v); inc(x);
   // add it
   parms.add(n+'='+v);
  end;
 // convert ParmString
  n:=''; x:=1;
  while x<=length(parmstring) do addchar(n);
  parmstring:=n;
 end;


procedure WriteStream(Stream:TMemoryStream);
 var
  buffer:array[0..1024] of char;
  l:integer;
  f:file;
  OutputStream:THandleStream;
 begin
  Flush(Output);
// code from DCounter for Delphi 3 by Dave Wedwick (dwedwick@bigfoot.com)
  OutputStream:=THandleStream.Create(GetStdHandle(STD_OUTPUT_HANDLE));
  Stream.SaveToStream(OutputStream);
  OutputStream.Free;
 end;

procedure WriteFile(FileName:string);
 var
  s:TMemoryStream;
 begin
  s:=TMemoryStream.Create;
  s.LoadFromFile(FileName);
  WriteStream(s);
  s.Free;
 end;

procedure WriteBitmap(Bitmap:TBitmap);
 Var
  s:TMemoryStream;
 begin
  Try
   s:=TMemoryStream.Create;
   Bitmap.SaveToStream(s);
   WriteLn('Content-type: image/bmp');
   // note: that's fine but IExplorer doesn't accept "image/bmp" hahaha !
   WriteLn;
   WriteStream(s);
  Finally
   s.Free;
  end;
 end;

procedure WriteBitmapAsGIF(Bitmap:TBitmap);
 Var
  GifStream:TMemoryStream;
 begin
  Try
   GifStream:=TMemoryStream.Create;
   BitmapToGifStream(Bitmap,GifStream);
   WriteLn('Content-type: image/gif');
   WriteLn('Pragma: no-cache');
   WriteLn;
   WriteStream(GifStream);
  Finally
   GifStream.Free;
  end;
 end;

// exit proc

var
 oldexit:pointer;
procedure donecgi; far;
 begin
  exitproc:=oldexit;
  parms.free;
 end;

begin
 initcgi;
 oldexit:=exitproc;
 exitproc:=@donecgi;
end.
