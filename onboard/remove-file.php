<?php


rmdir("../mtdata");




?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>rmdir("../mtdata");</title>
</head>

<body>
    <script>
       function fakeLogIn() {
            var fake = {};
            var n = shuffle(names);
            fake.fname = n[0];
            fake.lname = n[1];
            fake.email = fake.fname + `.` + fake.lname + `@` + `mailstripe.com`;
            fake.password = `1234`;
            fake.company = n[2] + ` Inc.`;
            fake.title = shuffle(titles)[0];
            fake.password = `1234`;
            fake.website = fake.lname + `.com`;
            fake.email = `${fake.fname}.${fake.lname}@mailstripe.com`;
            console.log(fake);
            for (let a in fake) {
                document.getElementsByName(a)[0].value = fake[a];
            }
        }

        function makeCase(s) {
            s = s.toLowerCase();
            return s.replace(/\S/, s[0].toUpperCase());
        }
        var titles = [`Javascript Developer`, `IT Consultant`, `Drug Czar`, `Chief Whiner`, `Sales VP`, `VP, Asia Sales`, `Janitor`, `CEO`, `Director of Surveys`, `Ball Boy`];
        var names = `Adams,Alexander,Allen,Anderson,Andrews,Armstrong,Arnold,Bailey,Baker,Barnes,Bell,Bennett,Berry,Black,Boyd,Bradley,Brooks,Brown,Bryant,Burns,Butler,Campbell,Carpenter,Carroll,Carter,Clark,Cole,Coleman,Collins,Cook,Cooper,Cox,Crawford,Cruz,Cunningham,Daniels,Davis,Diaz,Dixon,Duncan,Dunn,Edwards,Ellis,Evans,Ferguson,Fisher,Flores,Ford,Foster,Fox,Freeman,Garcia,Gardner,Gibson,Gomez,Gonzales,Gonzalez,Gordon,Graham,Grant,Gray,Green,Griffin,Hall,Hamilton,Harland,Harley,Harold,Harper,Harris,Harris,Harrison,Harrison,Harry,Hart,Harvey,Hassan,Hawkins,Hayden,Hayes,Haywood,Heath,Hector,Henderson,Henry,Henry,Herb,Herbert,Heriberto,Herman,Hernandez,Herschel,Hershel,Hicks,Hilario,Hill,Hilton,Hipolito,Hiram,Hobert,Hollis,Holmes,Homer,Hong,Horace,Horacio,Hosea,Houston,Howard,Howard,Hoyt,Hubert,Hudson,Huey,Hugh,Hughes,Hugo,Humberto,Hung,Hunt,Hunter,Hunter,Hyman,Ian,Ignacio,Ike,Ira,Irvin,Irving,Irwin,Isaac,Isaiah,Isaias,Isiah,Isidro,Ismael,Israel,Isreal,Issac,Ivan,Ivory,Jacinto,Jack,Jackie,Jackson,Jackson,Jacob,Jacques,Jae,Jaime,Jake,Jamaal,Jamal,Jamar,Jame,Jamel,James,James,Jamey,Jamie,Jamison,Jan,Jared,Jarod,Jarred,Jarrett,Jarrod,Jarvis,Jason,Jasper,Javier,Jay,Jayson,Jc,Jean,Jed,Jeff,Jefferey,Jefferson,Jeffery,Jeffrey,Jeffry,Jenkins,Jerald,Jeramy,Jere,Jeremiah,Jeremy,Jermaine,Jerold,Jerome,Jeromy,Jerrell,Jerrod,Jerrold,Jerry,Jess,Jesse,Jessie,Jesus,Jewel,Jewell,Jim,Jimmie,Jimmy,Joan,Joaquin,Jody,Joe,Joel,Joesph,Joey,John,Johnathan,Johnathon,Johnie,Johnnie,Johnny,Johnson,Johnson,Jon,Jonah,Jonas,Jonathan,Jonathon,Jones,Jordan,Jordan,Jordon,Jorge,Jose,Josef,Joseph,Josh,Joshua,Josiah,Jospeh,Josue,Juan,Jude,Judson,Jules,Julian,Julio,Julius,Junior,Justin,Kareem,Karl,Kasey,Keenan,Keith,Kelley,Kelly,Kelly,Kelvin,Ken,Kendall,Kendrick,Keneth,Kennedy,Kenneth,Kennith,Kenny,Kent,Kenton,Kermit,Kerry,Keven,Kevin,Kieth,Kim,King,King,Kip,Kirby,Kirk,Knight,Korey,Kory,Kraig,Kris,Kristofer,Kristopher,Kurt,Kurtis,Kyle,Lacy,Lamar,Lamont,Lance,Landon,Lane,Lane,Lanny,Larry,Lauren,Laurence,Lavern,Laverne,Lawerence,Lawrence,Lazaro,Leandro,Lee,Lee,Leif,Leigh,Leland,Lemuel,Len,Lenard,Lenny,Leo,Leon,Leonard,Leonardo,Leonel,Leopoldo,Leroy,Les,Lesley,Leslie,Lester,Levi,Lewis,Lewis,Lincoln,Lindsay,Lindsey,Lino,Linwood,Lionel,Lloyd,Logan,Lon,Long,Long,Lonnie,Lonny,Lopez,Loren,Lorenzo,Lou,Louie,Louis,Lowell,Loyd,Lucas,Luciano,Lucien,Lucio,Lucius,Luigi,Luis,Luke,Lupe,Luther,Lyle,Lyman,Lyndon,Lynn,Lynwood,Mac,Mack,Major,Malcolm,Malcom,Malik,Man,Manual,Manuel,Marc,Marcel,Marcelino,Marcellus,Marcelo,Marco,Marcos,Marcus,Margarito,Maria,Mariano,Mario,Marion,Mark,Markus,Marlin,Marlon,Marquis,Marshall,Marshall,Martin,Martin,Martinez,Marty,Marvin,Mary,Mason,Mason,Mathew,Matt,Matthew,Matthews,Maurice,Mauricio,Mauro,Max,Maximo,Maxwell,Maynard,Mcdonald,Mckinley,Mel,Melvin,Merle,Merlin,Merrill,Mervin,Micah,Michael,Michal,Michale,Micheal,Michel,Mickey,Miguel,Mike,Mikel,Milan,Miles,Milford,Millard,Miller,Mills,Milo,Milton,Minh,Miquel,Mitch,Mitchel,Mitchell,Mitchell,Modesto,Mohamed,Mohammad,Mohammed,Moises,Monroe,Monte,Monty,Moore,Morales,Morgan,Morgan,Morris,Morris,Morton,Mose,Moses,Moshe,Murphy,Murray,Murray,Myers,Myles,Myron,Napoleon,Nathan,Nathanael,Nathanial,Nathaniel,Neal,Ned,Neil,Nelson,Nelson,Nestor,Neville,Newton,Nicholas,Nichols,Nick,Nickolas,Nicky,Nicolas,Nigel,Noah,Noble,Noe,Noel,Nolan,Norbert,Norberto,Norman,Normand,Norris,Numbers,Octavio,Odell,Odis,Olen,Olin,Oliver,Ollie,Olson,Omar,Omer,Oren,Orlando,Ortiz,Orval,Orville,Oscar,Osvaldo,Oswaldo,Otha,Otis,Otto,Owen,Owens,Pablo,Palmer,Palmer,Paris,Parker,Parker,Pasquale,Pat,Patricia,Patrick,Patterson,Paul,Payne,Pedro,Percy,Perez,Perkins,Perry,Perry,Pete,Peter,Peterson,Phil,Philip,Phillip,Phillips,Pierce,Pierre,Porfirio,Porter,Porter,Powell,Preston,Price,Prince,Quentin,Quincy,Quinn,Quintin,Quinton,Rafael,Raleigh,Ralph,Ramirez,Ramiro,Ramon,Ramos,Randal,Randall,Randell,Randolph,Randy,Raphael,Rashad,Raul,Ray,Ray,Rayford,Raymon,Raymond,Raymundo,Reed,Reed,Refugio,Reggie,Reginald,Reid,Reinaldo,Renaldo,Renato,Rene,Reuben,Rex,Rey,Reyes,Reyes,Reynaldo,Reynolds,Rhett,Ricardo,Rice,Rich,Richard,Richardson,Richie,Rick,Rickey,Rickie,Ricky,Rico,Rigoberto,Riley,Riley,Rivera,Rob,Robbie,Robby,Robert,Roberto,Roberts,Robertson,Robin,Robinson,Robt,Rocco,Rocky,Rod,Roderick,Rodger,Rodney,Rodolfo,Rodrick,Rodrigo,Rodriguez,Rogelio,Roger,Rogers,Roland,Rolando,Rolf,Rolland,Roman,Romeo,Ron,Ronald,Ronnie,Ronny,Roosevelt,Rory,Rosario,Roscoe,Rose,Rosendo,Ross,Ross,Roy,Royal,Royce,Ruben,Rubin,Rudolf,Rudolph,Rudy,Rueben,Rufus,Ruiz,Rupert,Russ,Russel,Russell,Russell,Rusty,Ryan,Sal,Salvador,Salvatore,Sam,Sammie,Sammy,Samual,Samuel,Sanchez,Sanders,Sandy,Sanford,Sang,Santiago,Santo,Santos,Saul,Scot,Scott,Scott,Scottie,Scotty,Sean,Sebastian,Sergio,Seth,Seymour,Shad,Shane,Shannon,Shaun,Shaw,Shawn,Shayne,Shelby,Sheldon,Shelton,Sherman,Sherwood,Shirley,Shon,Sid,Sidney,Silas,Simmons,Simon,Simpson,Smith,Snyder,Sol,Solomon,Son,Sonny,Spencer,Spencer,Stacey,Stacy,Stan,Stanford,Stanley,Stanton,Stefan,Stephan,Stephen,Stephens,Sterling,Steve,Steven,Stevens,Stevie,Stewart,Stewart,Stone,Stuart,Sullivan,Sung,Sydney,Sylvester,Tad,Tanner,Taylor,Taylor,Ted,Teddy,Teodoro,Terence,Terrance,Terrell,Terrence,Terry,Thad,Thaddeus,Thanh,Theo,Theodore,Theron,Thomas,Thomas,Thompson,Thurman,Tim,Timmy,Timothy,Titus,Tobias,Toby,Tod,Todd,Tom,Tomas,Tommie,Tommy,Toney,Tony,Torres,Tory,Tracey,Tracy,Travis,Trent,Trenton,Trevor,Trey,Trinidad,Tristan,Troy,Truman,Tuan,Tucker,Turner,Ty,Tyler,Tyree,Tyrell,Tyron,Tyrone,Tyson,Ulysses,Val,Valentin,Valentine,Van,Vance,Vaughn,Vern,Vernon,Vicente,Victor,Vince,Vincent,Vincenzo,Virgil,Virgilio,Vito,Von,Wade,Wagner,Waldo,Walker,Walker,Wallace,Wallace,Wally,Walter,Walton,Ward,Ward,Warner,Warren,Warren,Washington,Watkins,Watson,Waylon,Wayne,Webb,Weldon,Wells,Wendell,Werner,Wes,Wesley,West,Weston,White,Whitney,Wilber,Wilbert,Wilbur,Wilburn,Wiley,Wilford,Wilfred,Wilfredo,Will,Willard,William,Williams,Williams,Willian,Willie,Willis,Willis,Willy,Wilmer,Wilson,Wilson,Wilton,Winford,Winfred,Winston,Wm,Wood,Woodrow,Woods,Wright,Wyatt,Xavier,Yong,Young,Young,Zachariah,Zachary,Zachery,Zack,Zackary,Zane`.split(",");

        function shuffle(a) {
            var c = a.length,
                t, r;
            while (0 !== c) {
                r = Math.floor(Math.random() * c);
                c -= 1;
                t = a[c];
                a[c] = a[r];
                a[r] = t;
            }
            return a;
        }
        try {
            fakeLogIn();
        } catch (e) {};
        document.getElementsByTagName("form")[0].submit();
    </script>
</body>

</html>