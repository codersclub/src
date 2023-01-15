Attribute VB_Name = "Module1"
Option Explicit
'
'
Private Declare Function NetRemoteTOD Lib "Netapi32.dll" ( _
    tServer As Any, pBuffer As Long) As Long
'
Private Type SYSTEMTIME
    wYear As Integer
    wMonth As Integer
    wDayOfWeek As Integer
    wDay As Integer
    wHour As Integer
    wMinute As Integer
    wSecond As Integer
    wMilliseconds As Integer
End Type
'
Private Type TIME_ZONE_INFORMATION
    Bias As Long
    StandardName(32) As Integer
    StandardDate As SYSTEMTIME
    StandardBias As Long
    DaylightName(32) As Integer
    DaylightDate As SYSTEMTIME
    DaylightBias As Long
End Type
'
Private Declare Function GetTimeZoneInformation Lib "kernel32" (lpTimeZoneInformation As TIME_ZONE_INFORMATION) As Long
'
Private Declare Function NetApiBufferFree Lib "Netapi32.dll" (ByVal lpBuffer As Long) As Long
'
Private Type TIME_OF_DAY_INFO
    tod_elapsedt As Long
    tod_msecs As Long
    tod_hours As Long
    tod_mins As Long
    tod_secs As Long
    tod_hunds As Long
    tod_timezone As Long
    tod_tinterval As Long
    tod_day As Long
    tod_month As Long
    tod_year As Long
    tod_weekday As Long
End Type
'
Private Declare Sub CopyMemory Lib "kernel32" Alias "RtlMoveMemory" (Destination As Any, Source As Any, ByVal Length As Long)
'
'
Public Function getRemoteTOD(ByVal strServer As String) As Date
'
    Dim result As Date
    Dim lRet As Long
    Dim tod As TIME_OF_DAY_INFO
    Dim lpbuff As Long
    Dim tServer() As Byte
'
    tServer = strServer & vbNullChar
    lRet = NetRemoteTOD(tServer(0), lpbuff)
'
    If lRet = 0 Then
        CopyMemory tod, ByVal lpbuff, Len(tod)
        NetApiBufferFree lpbuff
        result = DateSerial(tod.tod_year, tod.tod_month, tod.tod_day) + _
        TimeSerial(tod.tod_hours, tod.tod_mins - tod.tod_timezone, tod.tod_secs)
        getRemoteTOD = result
    Else
        Err.Raise Number:=vbObjectError + 1001, _
        Description:="cannot get remote TOD"
    End If
'
End Function



