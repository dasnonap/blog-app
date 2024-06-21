import { Link, Head } from "@inertiajs/react";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import Sidebar from "@/Components/sidebar";

export default function Tokens({ auth, tokens }) {
  return (
    <AuthenticatedLayout
      user={auth.user}
      header={
        <h2 className="font-semibold text-xl text-gray-800 leading-tight">
          Tokens
        </h2>
      }
    >
      <Head title="Tokens" />

      <div className="grid grid-cols-[minmax(312px,_30%)_1fr]">
        <Sidebar />

        <div className="container max-w-screen-md xl:max-w-screen-xl pt-10 xl:flex flex-wrap gap-8">
          {tokens && (
            <div className="flex justify-center flex-col">
              {tokens.map((token: string) => {
                return (
                  <div className="mt-16 first:mt-0 xl:flex-[1_0_calc(50%-2rem)] xl:mt-0">
                    <p>{`Dev Token: ` + token}</p>
                  </div>
                );
              })}
            </div>
          )}
        </div>
      </div>
    </AuthenticatedLayout>
  );
}
