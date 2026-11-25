<?php
class Hewan
{
    public function suara(): string
    {
        return "Suara hewan";
    }
}
class Kucing extends Hewan
{
    public function suara(): string
    {
        return "Meong!";
    }
}
class Anjing extends Hewan
{
    public function suara(): string
    {
        return "Guk guk!";
    }
}
class Ayam extends Hewan
{
    public function suara(): string
    {
        return "Kukuruyuk!";
    }
}

function bunyikan(Hewan $objek)
{
    echo $objek->suara() . "<br>";
}

bunyikan(new Kucing());
bunyikan(new Anjing());
bunyikan(new Ayam());
