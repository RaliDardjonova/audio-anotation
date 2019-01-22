use Proekt;

insert
into User(Username, Email, Password)
values ("ralica96Aa", "ralica@abv.bg", "$2y$10$sX1gHjPgumKgvGnhOHDqe.YJqfZhmbyE5SHR6JCHHLi1khFIDbfN6");

insert
into User(Username, Email, Password)
values ("OpaOpa4", "OpaOpa4@abv.bg", "$2y$10$S43v1gphcH0whvV/VibER.9AymmrTxfU.XpNVizDMMJXzArYPsIcW");

insert
into Audio(Username, Audioname, ReadableAudioname, Description)
values ("ralica96Aa", "ralica96Aa5c45fc01576427.55383128.mp3", "The Black Keys - Gold Оn Тhe Ceiling", "Песен на групата The Black Keys, издадена през 2011г.");

insert
into Audio(Username, Audioname, ReadableAudioname, Description)
values ("OpaOpa4", "OpaOpa45c45fc577b9762.31425292.wav", "Йога звуци", "Човек, който издава нежни звуци, докато прави йога.");


insert
into Comment(Username, Audioname, Comment, AtMoment)
values ("OpaOpa4", "ralica96Aa5c45fc01576427.55383128.mp3", "Много ми харесва тази част. Има хубаво соло.", 63.3099);

insert
into Comment(Username, Audioname, Comment, AtMoment)
values ("OpaOpa4", "ralica96Aa5c45fc01576427.55383128.mp3", "Припевът също ми харесва", 134.571);

insert
into Comment(Username, Audioname, Comment, AtMoment)
values ("OpaOpa4", "OpaOpa45c45fc577b9762.31425292.wav", "И аз обичам да издавам такива звуци, повреме на йога :)",2.75821);

insert
into Comment(Username, Audioname, Comment, AtMoment)
values ("ralica96Aa", "OpaOpa45c45fc577b9762.31425292.wav", "Това не са йога звуци, не мога да се концентрирам :(",0);

insert
into Comment(Username, Audioname, Comment, AtMoment)
values ("ralica96Aa", "OpaOpa45c45fc577b9762.31425292.wav", "Очаквах пак да крещи и тука.", 8.16279);

insert
into Comment(Username, Audioname, Comment, AtMoment)
values ("ralica96Aa", "ralica96Aa5c45fc01576427.55383128.mp3", "Яко начало <3", 8.26168);
