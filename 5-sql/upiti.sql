-- 1
select * 
from `Order`
where dateCreate >= date_sub(now(), interval 3 day);

-- 2
select o.id, o.value, u.firstname, u.lastname
from `Order` o
join User u on o.userId = u.id;

-- 3
select u.firstname, u.lastname, count(o.id) as broj_porudzbina
from User u
left join `Order` o on o.userId = u.id
group by u.id, u.firstname, u.lastname;

-- 4
select round(avg(stavke)) as prosecno_proizvoda
from (
    select orderId, count(*) as stavke
    from OrderItem
    group by orderId
) as podupit;

-- 5
select p.name, count(oi.id) as broj_prodaja
from Product p
join OrderItem oi on oi.productId = p.id
group by p.id, p.name
order by broj_prodaja desc
limit 3;

-- 6 iznos porudzbine veci od prosecnog iznosa porudzbine
select u.firstname, u.lastname, o.value
from User u
join `Order` o on u.id = o.userId
where o.value > (select avg(value) from `Order`);

-- 6 broj porudzbina veci od prosecnog broja porudzbina
select u.firstname, u.lastname, count(o.id) as broj_porudzbina
from User u
join `Order` o on u.id = o.userId
group by u.id, u.firstname, u.lastname
having count(o.id) > (
    select avg(broj) 
    from (
        select count(id) as broj
        from `Order`
        group by userId
    ) as podupit
);