import JSZip from "jszip";
import fs from "fs";
import path from "path";

export async function POST(req) {

  const form = await req.formData();

  const file = form.get("file");

  const key = form.get("key") || "49";

  const delay = form.get("delay") || "100";


  const buffer = Buffer.from(
    await file.arrayBuffer()
  );


  const zip = await JSZip.loadAsync(buffer);



  // Lấy thư mục javak
  const javakPath = path.join(
    process.cwd(),
    "lib/javak"
  );


  // Chèn file AutoClick
  function addFolder(folder, base="") {

    const files = fs.readdirSync(folder);


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
