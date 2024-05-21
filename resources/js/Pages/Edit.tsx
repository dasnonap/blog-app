import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';

export default function Edit({auth, post}){
    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className='font-semibold text-xl text-xl text-gray-800 leading-tight'>Edit Post</h2>}
        >
            <Head title="Edit" />

            
        </AuthenticatedLayout>
    )
}