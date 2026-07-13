
async function buildJar(){
 const jarFile=document.getElementById('jar').files[0];
 const cls=[...document.getElementById('classes').files];
 if(!jarFile){alert('Chọn file JAR');return;}
 let zip=await JSZip.loadAsync(await jarFile.arrayBuffer());

 for(const f of cls){
   zip.file('javak/'+f.name, await f.arrayBuffer());
 }

 let mf=zip.file('META-INF/MANIFEST.MF');
 let text=mf ? await mf.async('text') : 'Manifest-Version: 1.0\n';
 if(!text.includes('AutoClick-VIP'))
   text += '\nCreated-By: Nguyen Duc Manh\nAutoClick-VIP: ON\n';
 zip.file('META-INF/MANIFEST.MF',text);

 const blob=await zip.generateAsync({type:'blob'});
 const a=document.createElement('a');
 a.href=URL.createObjectURL(blob);
 a.download='Game-AutoClick-VIP.jar';
 a.click();
 document.getElementById('msg').innerText='Đã tạo JAR VIP!';
}
