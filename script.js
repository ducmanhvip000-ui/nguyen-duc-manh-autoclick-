
async function run(){
 let f=document.getElementById('jar').files[0];
 if(!f)return alert('Chọn jar');
 let z=await JSZip.loadAsync(await f.arrayBuffer());

 // patch giống PHP
 for(let name of Object.keys(z.files)){
   let e=z.files[name];
   if(!e.dir && (name.endsWith('.class')||name.endsWith('.txt'))){
    let b=await e.async('uint8array');
    let s=new TextDecoder().decode(b);
    s=s.replaceAll('javax/microedition/lcdui/Canvas','javak/microedition/lcdui/Kalvaz')
     .replaceAll('keyPressed','KeyPressed')
     .replaceAll('keyReleased','KeyReleased')
     .replaceAll('keyRepeated','KeyRepeated')
     .replaceAll('javax/microedition/midlet/MIDlet','javak/microedition/midlet/MiDlet');
    z.file(name,new TextEncoder().encode(s));
   }
 }

 let files=document.getElementById('cls').files;
 for(let x of files) z.file('javak/'+x.name, await x.arrayBuffer());

 z.file('javak/config.txt',document.getElementById('key').value);
 z.file('khuonga2.txt','mod addlight online by Nguyen Duc Manh');

 let mf=z.file('META-INF/MANIFEST.MF');
 let m=mf?await mf.async('text'):'Manifest-Version: 1.0\n';
 m += '\nAutoClick-VIP: ON\nCreated-By: Nguyen Duc Manh\n';
 z.file('META-INF/MANIFEST.MF',m);

 let blob=await z.generateAsync({type:'blob'});
 let a=document.createElement('a');
 a.href=URL.createObjectURL(blob);
 a.download='AutoClick-VIP-FULL.jar';
 a.click();
 document.getElementById('out').innerText='Xong';
}
