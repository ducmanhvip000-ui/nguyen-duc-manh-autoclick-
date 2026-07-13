import JSZip from "jszip";
import fs from "fs";
import path from "path";


export async function POST(req){

try{


const form = await req.formData();

const file = form.get("file");

const key = form.get("key") || "49";

const delay = form.get("delay") || "100";



const buffer = Buffer.from(
await file.arrayBuffer()
);



const zip = await JSZip.loadAsync(buffer);



// =====================
// 1. Patch Midlet
// =====================


for(
const name of Object.keys(zip.files)
){


if(
name.endsWith(".class")
){

let data =
await zip.file(name)
.async("nodebuffer");


let text =
data.toString("latin1");


// Ninja School dùng Midlet
text =
text.replaceAll(
"Midlet",
"MiDlet"
);


// hỗ trợ game khác
text =
text.replaceAll(
"MIDlet",
"MiDlet"
);


zip.file(
name,
Buffer.from(text,"latin1")
);


}

}



// =====================
// 2. Thêm AutoClick Engine
// =====================


const javakPath =
path.join(
process.cwd(),
"lib/javak"
);



function addFolder(dir,base=""){


for(
const item of fs.readdirSync(dir)
){


const full =
path.join(dir,item);


const rel =
path.join(base,item);



if(
fs.statSync(full).isDirectory()
){

addFolder(full,rel);


}else{


zip.file(
"javak/"+rel,
fs.readFileSync(full)
);


}


}


}



addFolder(javakPath);




// =====================
// 3. Config
// =====================


zip.file(
"javak/config.txt",
`
AUTOCLICK=true
KEY=${key}
DELAY=${delay}
GAME=NinjaSchool
AUTHOR=Nguyen Duc Manh
`
);




// =====================
// 4. Xuất file
// =====================


const output =
await zip.generateAsync({
type:"nodebuffer"
});



return new Response(
output,
{
headers:{
"Content-Type":
"application/java-archive",

"Content-Disposition":
"attachment; filename=NinjaSchool-AutoClick.jar"

}
}
);



}catch(e){


return new Response(
"ERROR: "+e.message,
{
status:500
}
);


}


}
    for (const f of files) {

      const full = path.join(folder,f);

      const rel = path.join(
        base,
        f
      );


      if(fs.statSync(full).isDirectory()){

        addFolder(full, rel);

      } else {

        zip.file(
          "javak/" + rel,
          fs.readFileSync(full)
        );

      }

    }

  }


  addFolder(javakPath);



  // Tạo config

  zip.file(
    "javak/config.txt",
`
AUTOCLICK=true
KEY=${key}
DELAY=${delay}
AUTHOR=Nguyễn Đức Mạnh
`
);



  const output =
    await zip.generateAsync({
      type:"nodebuffer"
    });



  return new Response(output,{
    headers:{
      "Content-Type":
      "application/java-archive",

      "Content-Disposition":
      "attachment; filename=AutoClick-Mod.jar"
    }
  });

}
