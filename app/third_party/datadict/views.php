<?php

$views = array();

$views['viewusers'] = "
SELECT u.id, u.email, u.username, u.mobile, u.disabled, u.rolecode ,r.rolename, u.instcode,i.instname, u.audituser
FROM sysusers u
 LEFT JOIN sysroles r on r.rolecode=u.rolecode
 LEFT JOIN institutions i on i.instcode=u.instcode

";

//researchers,countries
$views['viewresearchers'] = "
select s.id,s.idpassno,s.orcidid,s.orcidname,s.accesstoken,s.tokentype,s.refreshtoken,s.tokenexpiry,s.tokenscope,s.firstname,s.lastname,s.midname,s.fullname,
s.gender,s.ctncode,s.email,s.title,s.dob,s.idpassip,s.idpassdi,s.idpassdx,s.institutionname,s.qualification,s.specarea,s.mobile,s.postaddress,
s.postcode,s.town,s.prmaddress,s.prmpcode,s.prmtown,s.prmphone,s.prmresidence,s.secaddress,s.secpcode,s.sectown,s.secphone,s.secresidence,s.empaddress,
s.emppcode,s.emppzip,s.emptown,s.emphone,s.empctncode,s.empcountry,s.password,s.verifycode,s.verifydate,s.verified,s.hasuploads,s.docpassport,s.docid,s.docidpass,s.urlphoto,
s.active,s.setup,s.regdate,s.regtime,s.pinno,o.ctnname,o.natcode,o.ntnname
from researchers s
  left join countries o on o.ctncode=s.ctncode
  
 ";

$views['viewinstitutions'] = "
select v.id,v.instcode,v.instname,v.instphoto,v.photourl,v.thumburl,v.permitdesc,v.charges,v.consultemail,v.consultperson,
v.paytimecode, t.paytimename, t.isbfrsub, t.isbfrapr,
v.licmdcode,e.licmdname,e.isauto,e.ismanapp,e.ismanins,e.isemail,
s.stepno, s.stepname, s.stepdesc, s.emtplaplapr ,s.emtplapldsp, s.emtplinsapr, s.emtplinsdsp,
v.api_username,v.api_password,v.api_baseurl
from institutions v
left join licmodes e on e.licmdcode=v.licmdcode
left join paytimes t on t.paytimecode=v.paytimecode
left join approvesteps s on s.instcode=v.instcode

";


$views['viewapprovesteps'] = "
SELECT s.id, s.stepno, s.stepname, s.stepdesc, s.instcode, i.instname,s.emtplaplapr ,s.emtplapldsp, s.emtplinsapr, s.emtplinsdsp
FROM approvesteps s
 LEFT JOIN institutions i on i.instcode=s.instcode
";


$views['viewapplicationsnew'] = "
select y.id,y.appno,y.email,s.firstname,s.lastname,s.gender,s.ctncode,c.ctnname,s.mobile,
y.position,y.applyingas,a.asname applyingasname,y.orcid,y.researcherid,y.legalofficername,y.legalofficeremail,y.resourcetype,r.typename resourcetypename,y.speciesname,
y.scientificname,y.commonname,y.projectlocation,y.projectarea,y.resourceallocationpurpose,y.exportanswer,y.resourcetypeother,y.purpose,y.purposeother,
y.documentregistration,y.documentresearchproposal,y.documentaffiliation,y.documentresearchbudget,y.documentcv,y.documentpic,y.documentmat,y.documentmta,y.documentip,y.docpayment,
y.researchtype,t.typename researchtypename,y.samplesamount,y.conservestatus,y.conservestatusdesc,y.restraditionalknow,y.exportgeneticresources,y.legislationagree,y.sampleuom,u.uomname sampleuomname,y.apptime,
y.approved1,y.approved2,y.approved3,y.approved4,y.approved5,y.approved6,y.approved7,y.approved8,y.approved9,y.approved10,
y.aprcomment1,y.aprcomment2,y.aprcomment3,y.aprcomment4,y.aprcomment5,y.aprcomment6,y.aprcomment7,y.aprcomment8,y.aprcomment9,y.aprcomment10,
y.discomment1,y.discomment2,y.discomment3,y.discomment4,y.discomment5,y.discomment6,y.discomment7,y.discomment8,y.discomment9,y.discomment10,
y.paid1,y.paid2,y.paid3,y.paid4,y.paid5,y.paid6,y.paid7,y.paid8,y.paid9,y.paid10,
y.payref1,y.payref2,y.payref3,y.payref4,y.payref5,y.payref6,y.payref7,y.payref8,y.payref9,y.payref10,
y.paytime1,y.paytime2,y.paytime3,y.paytime4,y.paytime5,y.paytime6,y.paytime7,y.paytime8,y.paytime9,y.paytime10,
y.paymode1,y.paymode2,y.paymode3,y.paymode4,y.paymode5,y.paymode6,y.paymode7,y.paymode8,y.paymode9,y.paymode10, y.routed ,y.instcode

from applications y
inner join researchers s on s.email=y.email
left join countries c on c.ctncode= s.ctncode
left join applyas a on a.ascode= y.applyingas
left join researchtypes t on t.typecode= y.researchtype
left join resourcetypes r on r.typecode= y.resourcetype
left join sampleuom u on u.uomcode= y.sampleuom

where routed is null
";

$views['viewapplications'] = "
select y.id,y.appno,y.email,s.firstname,s.lastname,s.gender,s.ctncode,c.ctnname,s.mobile,
y.position,y.applyingas,a.asname applyingasname,y.orcid,y.researcherid,y.legalofficername,y.legalofficeremail,y.resourcetypes,y.resourcetype,r.typename resourcetypename,y.speciesname,
y.scientificname,y.commonname,y.projectlocation,y.projectarea,y.resourceallocationpurpose,y.exportanswer,y.resourcetypeother,y.export_port, y.export_country,y.purpose,y.purposeother,
y.documentregistration,y.documentresearchproposal,y.documentaffiliation,y.documentresearchbudget,y.documentcv,y.documentpic,y.documentmat,y.documentmta,y.documentip,y.docpayment,
y.researchtype,t.typename researchtypename,y.samplesamount,y.conservestatus,y.conservestatusdesc,y.restraditionalknow,y.exportgeneticresources,y.legislationagree,y.sampleuom,u.uomname sampleuomname,y.apptime,
y.approved1,y.approved2,y.approved3,y.approved4,y.approved5,y.approved6,y.approved7,y.approved8,y.approved9,y.approved10,
y.aprcomment1,y.aprcomment2,y.aprcomment3,y.aprcomment4,y.aprcomment5,y.aprcomment6,y.aprcomment7,y.aprcomment8,y.aprcomment9,y.aprcomment10,
y.discomment1,y.discomment2,y.discomment3,y.discomment4,y.discomment5,y.discomment6,y.discomment7,y.discomment8,y.discomment9,y.discomment10,
y.paid1,y.paid2,y.paid3,y.paid4,y.paid5,y.paid6,y.paid7,y.paid8,y.paid9,y.paid10,
y.payref1,y.payref2,y.payref3,y.payref4,y.payref5,y.payref6,y.payref7,y.payref8,y.payref9,y.payref10,
y.paytime1,y.paytime2,y.paytime3,y.paytime4,y.paytime5,y.paytime6,y.paytime7,y.paytime8,y.paytime9,y.paytime10,
y.paymode1,y.paymode2,y.paymode3,y.paymode4,y.paymode5,y.paymode6,y.paymode7,y.paymode8,y.paymode9,y.paymode10, y.routed ,y.instcode

from applications y
inner join researchers s on s.email=y.email
left join countries c on c.ctncode= s.ctncode
left join applyas a on a.ascode= y.applyingas
left join researchtypes t on t.typecode= y.researchtype
left join resourcetypes r on r.typecode= y.resourcetype
left join sampleuom u on u.uomcode= y.sampleuom

";

$views['viewapproved1'] = "
select * from  viewapplications  where  approved1=1 and (approved2 is null  or approved2=0)
";

