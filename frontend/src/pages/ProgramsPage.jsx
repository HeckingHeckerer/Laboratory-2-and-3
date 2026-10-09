import { ReferenceDataPage } from '../components/ReferenceDataPage.jsx'
import service from '../services/programService.js'
const fields = [{ name: 'code', label: 'Program code', required: true }, { name: 'name', label: 'Program name', required: true }, { name: 'description', label: 'Description' }, { name: 'status', label: 'Status', type: 'select', options: ['Active', 'Inactive'], default: 'Active', required: true }]
export function ProgramsPage() { return <ReferenceDataPage title="Programs" service={service} fields={fields} columns={fields.filter((field) => field.name !== 'description')} /> }
