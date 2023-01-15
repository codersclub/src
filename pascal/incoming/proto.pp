unit proto;
interface
uses
 sockets;
{
  Automatically converted by H2Pas 0.99.15 from proto.txt
  The following command line parameters were used:
    proto.txt
}

{$PACKRECORDS C}


  const
     DEBUG = false;
  { was #define dname def_expr }
  function PACKET_SIZE : longint;
      { return type might be wrong }


  const
     VERSION = 0;
     BUILD = 9;
     MAX_ONLINE_USERS = 256;
     INVALID_SOCKET = -(1);
     SERVER_UID = 0;
     SERVER_NAME = 'dark machine';
     SERVER_ADMIN = 'deil';
     SERVER_ADMIN_EMAIL = 'deil@real.xakep.ru';
     SERVER_MOTD = 'it is not stable release coz it is author is lamer send info about all bugs to deil@real.xakep.ru :]';
     MY_VERSION = '0.1.1';
  { + }
     CMD_INFO = 0;
  { + }
     CMD_LOGIN = 1;
  { + }
     CMD_STATUS = 2;
  { + }
     CMD_REGISTER = 3;
  { + }
     CMD_GETSTATUS = 4;
  { + }
     CMD_GETADDR = 5;
  { + }
     CMD_SETINFO = 6;
  { + }
     CMD_GETINFO = 7;
  { + }
     CMD_MSG = 10;
  { + }
     CMD_PING = 99;
  { + }
     CMD_LOGOUT = 100;
  { + }
     RPL_INFO = 100;
  { + }
     RPL_LOGIN = 101;
  { а оно тут нужно? надо будет убрать -) }
     RPL_STATUS = 102;
  { + }
     RPL_REGISTER = 103;
  { + }
     RPL_GETSTATUS = 104;
  { + }
     RPL_GETADDR = 105;
  { + }
     RPL_SETINFO = 106;
  { + }
     RPL_GETINFO = 107;
  { + }
     RPL_MSG = 110;
  { + }
     RPL_PING = 199;
  { + }
     RPL_LOGOUT = 200;
     STAT_ONLINE = 255;
     STAT_OFFLINE = 0;
     STAT_AWAY = 1;
     STAT_INVISIBLE = 2;
  { linker error :( }

  type
     __version = record
          v : byte;
          b : byte;
          zero : array[0..1] of char;
       end;

     _version = record
          i_vers : __version;
       end;

     _packet = record
          version : _version;
          cmd : byte;
          from : dword;
          _to : dword;
          data : array[0..1023] of byte;
       end;

     _user = record
          uid : dword;
          login : array[0..9] of char;
          him : {sockaddr_in}TInetSockAddr;
          sock : longint;
          status : byte;
          {ping_time : tm;}
       end;

     _user_info = record
          uid : dword;
          status : byte;
          name : array[0..24] of char;
          email : array[0..29] of char;
          male : boolean;
          country : array[0..14] of char;
          city : array[0..14] of char;
          about : array[0..127] of char;
       end;

     _login = record
          login : array[0..9] of char;
          password : array[0..9] of char;
          ok : byte;
          reason : array[0..99] of char;
       end;

     _info = record
          status : byte;
          users_max : dword;
          users_num : dword;
          server_name : array[0..49] of char;
          server_admin : array[0..49] of char;
          server_adm_mail : array[0..49] of char;
          motd : array[0..199] of char;
       end;


implementation

  { was #define dname def_expr }
  function PACKET_SIZE : longint;
      { return type might be wrong }
      begin
         PACKET_SIZE:=sizeof(_packet);
      end;


end.
