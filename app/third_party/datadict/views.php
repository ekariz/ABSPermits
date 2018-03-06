<?php

$views = array();

$views['viewusers'] = "
SELECT u.id, u.email, u.username, u.mobile, u.disabled, u.rolecode ,r.rolename, u.instcode,i.instname, u.audituser
FROM sysusers u
 LEFT JOIN sysroles r on r.rolecode=u.rolecode
 LEFT JOIN institutions i on i.instcode=u.instcode

";

$views['viewapplications'] = "
select y.id,y.appno,y.email,s.firstname,s.lastname,s.gender,s.ctncode,c.ctnname,s.mobile,
y.position,y.applyingas,a.asname applyingasname,y.orchid,y.researcherid,y.legalofficername,y.legalofficeremail,y.resourcetype,r.typename resourcetypename,y.speciesname,
y.scientificname,y.commonname,y.projectlocation,y.projectarea,y.resourceallocationpurpose,y.exportanswer,y.resourcetypeother,y.purpose,y.purposeother,
y.documentregistration,y.documentresearchproposal,y.documentaffiliation,y.documentresearchbudget,y.documentcv,y.documentpic,y.documentmat,y.documentmta,
y.researchtype,t.typename researchtypename,y.samplesamount,y.conservestatus,y.conservestatusdesc,y.restraditionalknow,y.exportgeneticresources,y.legislationagree,y.sampleuom,u.uomname sampleuomname,y.apptime,
y.approved1,y.approved2,y.approved3,y.approved4,y.approved5,y.approved6,y.approved7,y.approved8,y.approved9,y.approved10
from applications y
inner join signups s on s.email=y.email
left join countries c on c.ctncode= s.ctncode
left join applyas a on a.ascode= y.applyingas
left join researchtypes t on t.typecode= y.researchtype
left join resourcetypes r on r.typecode= y.resourcetype
left join sampleuom u on u.uomcode= y.sampleuom


";

