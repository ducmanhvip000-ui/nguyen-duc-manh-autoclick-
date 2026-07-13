"use client";

import { useState } from "react";

export default function Home() {

  const [file, setFile] = useState(null);
  const [key, setKey] = useState("49");
  const [delay, setDelay] = useState("100");
  const [loading, setLoading] = useState(false);


  async function handleMod(){

    if(!file){
      alert("Hãy chọn file JAR trước");
      return;
    }


    setLoading(true);


    const form = new FormData();

    form.append("file", file);
    form.append("key", key);
    form.append("delay", delay);



    const res = await fetch("/api/mod",{
      method:"POST",
      body:form
    });



    const blob = await res.blob();


    const url = URL.createObjectURL(blob);


    const a = document.createElement("a");

    a.href = url;

    a.download = "AutoClick-Mod.jar";

    a.click();


    setLoading(false);

  }



return (

<main className="
min-h-screen
bg-black
text-white
flex
items-center
justify-center
p-5
">


<div className="
w-full
max-w-md
bg-zinc-900
rounded-3xl
p-6
shadow-xl
">


<h1 className="
text-3xl
font-bold
text-center
mb-2
">

🚀 Nguyễn Đức Mạnh

</h1>


<h2 className="
text-center
text-gray-400
mb-6
">

JAVA AUTOCLICK TOOL

</h2>



<div className="
border-2
border-dashed
border-gray-600
rounded-xl
p-5
mb-5
text-center
">


<p className="mb-3">

📦 Chọn file JAR

</p>


<input

type="file"

accept=".jar,.zip"

onChange={
(e)=>setFile(e.target.files[0])
}

/>


</div>




<label>

Phím AutoClick

</label>


<select

className="
w-full
text-black
p-3
rounded-xl
mb-4
"

value={key}

onChange={
(e)=>setKey(e.target.value)
}

>

<option value="49">
Phím 1
</option>

<option value="50">
Phím 2
</option>

<option value="53">
Phím 5
</option>

<option value="54">
Phím 6
</option>

</select>




<label>

Delay (ms)

</label>


<input

className="
w-full
text-black
p-3
rounded-xl
mb-5
"

value={delay}

onChange={
(e)=>setDelay(e.target.value)
}

/>



<button

onClick={handleMod}

className="
w-full
bg-blue-600
hover:bg-blue-700
p-4
rounded-xl
font-bold
"

>

{

loading

?

"⏳ Đang xử lý..."

:

"⚡ MOD AUTO CLICK"

}


</button>



<p className="
text-center
text-gray-500
mt-6
">

Powered by Đức Mạnh

</p>


</div>


</main>

)

}
