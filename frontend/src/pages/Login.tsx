import { useForm } from 'react-hook-form';
import { zodResolver } from '@hookform/resolvers/zod'; import * as z from 'zod';
import { useLoginMutation } from '../features/auth/authApi'; import { useAppDispatch } from '../hooks';
import { logout, setToken } from '../features/auth/authSlice';

const schema = z.object({ 
  email: z.string().email(), 
  password: z.string().min(1) 
});
type Form = z.infer<typeof schema>;

export default function Login() {
  const { register, handleSubmit, formState:{errors} } = useForm<Form>({ resolver: zodResolver(schema) });
  const [login, { isLoading, error }] = useLoginMutation(); 
  const dispatch = useAppDispatch();

  return (
    <form onSubmit={handleSubmit(async (v) => {
      dispatch(logout());
      const r = await login(v).unwrap(); 
      dispatch(setToken(r.token)); 
    })}>
      <input placeholder="email" {...register('email')} />
      {errors.email && <small>{errors.email.message}</small>}
      <input placeholder="password" type="password" {...register('password')} />
      {errors.password && <small>{errors.password.message}</small>}
      <button disabled={isLoading}>Login</button>
      {error && <div>Login failed</div>}
    </form>
  );
}
