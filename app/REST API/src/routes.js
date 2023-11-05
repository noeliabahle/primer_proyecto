import { Router } from 'express';
import { producto } from './controller.js';

export const router = Router()

router.get('/productos', producto.getAll);
router.post('/productos', producto.add);
router.delete('/productos', producto.delete);
router.put('/productos', producto.update);