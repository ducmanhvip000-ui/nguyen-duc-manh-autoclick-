const files = {
"javak/K":"", 
"javak/microedition/lcdui/Kalvaz.class":"",
"javak/microedition/lcdui/KalvazAutoClick.class":"",
"javak/microedition/lcdui/Kalvazkey.class":"",
"javak/microedition/midlet/MiDlet.class":"",
"javak/microedition/midlet/MiDletKeySelector.class":""
};

document.getElementById('run').onclick=async()=>{
 const f=document.getElementById('jar').files[0];
 if(!f){alert("Chọn file jar/zip");return;}
 const zip=await JSZip.loadAsync(await f.arrayBuffer());
 const out=new JSZip();
 for(const name of Object.keys(zip.files)){
   let data=await zip.files[name].async("uint8array");
   let s=new TextDecoder("latin1").decode(data);
   s=s.replaceAll("javax/microedition/lcdui/Canvas","javak/microedition/lcdui/Kalvaz")
      .replaceAll("keyPressed","KeyPressed")
      .replaceAll("keyReleased","KeyReleased")
      .replaceAll("keyRepeated","KeyRepeated")
      .replaceAll("javax/microedition/midlet/MIDlet","javak/microedition/midlet/MiDlet");
   out.file(name,s);
 }
 out.file("javak/config.txt",document.getElementById('key').value);
 out.file("khuonga2.txt","mod addlight online by khuonga2");
 const blob=await out.generateAsync({type:"blob"});
 const a=document.createElement("a"); a.href=URL.createObjectURL(blob);
 a.download=f.name.replace(/\.zip$|_jar$/i,".jar");
 a.click();
 document.getElementById('msg').innerText="Đã tạo file";
};