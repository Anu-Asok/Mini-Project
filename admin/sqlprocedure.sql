  delimiter //
  create procedure test12(in d date, in trainid int, in available int)
   begin
    if dayofweek(d) in (select Dayofweek from Days_available where Train_ID=trainid) then
      insert into Train_status values(trainid,d,available,0);
    else
      call raise_error;
    end if;
   end//
  delimiter ;
