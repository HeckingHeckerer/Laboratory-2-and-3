import { useEffect, useState } from 'react'
import { ReferenceDataPage } from '../components/ReferenceDataPage.jsx'
import service from '../services/gradeService.js'
import enrollmentService from '../services/enrollmentService.js'
import { useAuth } from '../context/AuthContext.jsx'
import { InstructorGradeRoster } from '../components/InstructorGradeRoster.jsx'
export function GradesPage(){const {hasRole}=useAuth();const [enrollments,setEnrollments]=useState([]);useEffect(()=>{if(!hasRole('Instructor'))enrollmentService.list().then(x=>setEnrollments(x.data??[]))},[hasRole]);if(hasRole('Instructor'))return <InstructorGradeRoster/>;const fields=[{name:'enrollment_id',label:'Enrollment',type:'select',options:enrollments.map(x=>String(x.id)),required:true},{name:'grade',label:'Grade',type:'number'},{name:'remarks',label:'Remarks'}];return <ReferenceDataPage title="Grades" service={service} fields={fields} columns={[{name:'enrollment_id',label:'Enrollment ID'},{name:'grade',label:'Grade'},{name:'remarks',label:'Remarks'}]}/>}
