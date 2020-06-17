// repetidos de tb
select *, count(*) as repetidos_tb
from p03_tb
group by  p03_finyeccion, r01_id, p03_tipoPrueba
having count(*)>1
order by repetidos_tb

// repetidos de gr
select *, count(*) as repetidos_br
from p03_br
group by  p03_fmuestreo, r01_id, p03_tipoPrueba
having count(*)>1
order by repetidos_br

// repetidos de vc
select *, count(*) as repetidos_vc
from p03_vc
group by  p03_fexpedicion, r01_id
having count(*)>1
order by repetidos_vc

// repetidos de gr
select *, count(*) as repetidos_gr
from p03_gr
group by p03_fec_exp, r01_id, c07_id
having count(*)>1
order by repetidos_gr