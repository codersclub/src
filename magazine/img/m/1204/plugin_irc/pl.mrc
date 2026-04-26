alias ShowTrack { 
  set %Music.LastName abcEmpty  
  .timerWinAmp 0 5 StartTimerTrack
}

alias StartTimerTrack {
  set %Music.CurrentName $dll($mircdir\Project2.dll,procname,abcEmpty)
  if (%Music.CurrentName != %Music.LastName) {
    ame слушает %Music.CurrentName
    set %Music.LastName %Music.CurrentName
  }
}

menu channel {
  Показ трэков
  .Показывать: ShowTrack
  .Не показывать: .timerWinAmp off
}
